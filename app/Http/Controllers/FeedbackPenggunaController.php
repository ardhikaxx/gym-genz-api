<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FeedbackPenggunaController extends Controller
{
    /**
     * Display a listing of the feedback.
     */
    public function index()
    {
        $feedbacks = Feedback::with('pengguna')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $hasAnalysis = false;
        $analysisSummary = null;
        
        try {
            $analysisPath = storage_path('app/sentiment_analysis/results.json');
            if (file_exists($analysisPath)) {
                $analysisData = json_decode(file_get_contents($analysisPath), true);
                if ($analysisData && isset($analysisData['status']) && $analysisData['status'] === 'success') {
                    $hasAnalysis = true;
                    $analysisSummary = [
                        'total_feedback' => $analysisData['summary']['total_feedback'] ?? 0,
                        'positive' => $analysisData['summary']['sentiment_distribution']['positive'] ?? 0,
                        'negative' => $analysisData['summary']['sentiment_distribution']['negative'] ?? 0,
                        'neutral' => $analysisData['summary']['sentiment_distribution']['neutral'] ?? 0,
                        'mrr' => $analysisData['mrr'] ?? 0,
                        'analysis_date' => $analysisData['summary']['analysis_date'] ?? null
                    ];
                }
            }
        } catch (\Exception $e) {
            Log::error('Error loading analysis data: ' . $e->getMessage());
        }
            
        return view('admins.feedback-pengguna.index', compact('feedbacks', 'hasAnalysis', 'analysisSummary'));
    }

    /**
     * Display the specified feedback.
     */
    public function show($id)
    {
        try {
            $feedback = Feedback::with('pengguna')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $feedback
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Run sentiment analysis
     */
    public function analyzeSentiment(Request $request)
    {
        try {
            // Path ke script Python
            $pythonScript = base_path('scripts/sentiment_analysis.py');
            $pythonExecutable = base_path('scripts/venv/Scripts/python.exe');
            
            if (!file_exists($pythonScript)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Script analisis sentimen tidak ditemukan.'
                ], 404);
            }
            
            if (!file_exists($pythonExecutable)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Python executable tidak ditemukan. Silakan jalankan install_python_deps.bat terlebih dahulu.'
                ], 404);
            }
            
            // Jalankan script Python dengan timeout 300 detik (5 menit)
            $command = escapeshellcmd("\"{$pythonExecutable}\" \"{$pythonScript}\" 2>&1");
            
            // Eksekusi command
            $output = [];
            $returnVar = 0;
            $descriptorspec = [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"]  // stderr
            ];
            
            $process = proc_open($command, $descriptorspec, $pipes);
            
            if (is_resource($process)) {
                fclose($pipes[0]); // Close stdin
                
                // Read stdout
                $stdout = stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                
                // Read stderr
                $stderr = stream_get_contents($pipes[2]);
                fclose($pipes[2]);
                
                $returnVar = proc_close($process);
                
                // Gabungkan output
                $outputString = trim($stdout);
                
                // Log error jika ada
                if (!empty($stderr)) {
                    Log::error('Python script stderr: ' . $stderr);
                }
                
                // Log output untuk debugging
                Log::info('Python script output: ' . $outputString);
                
                if ($returnVar !== 0) {
                    Log::error('Python script error, return code: ' . $returnVar);
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menjalankan analisis sentimen. Kode error: ' . $returnVar . '. ' . $stderr
                    ], 500);
                }
            } else {
                Log::error('Failed to open process for Python script');
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menjalankan proses Python.'
                ], 500);
            }
            
            // Parse JSON output dari Python
            // Cari JSON dalam output (handle extra print statements)
            $jsonStart = strpos($outputString, '{"status"');
            $jsonEnd = strrpos($outputString, '}') + 1;
            
            if ($jsonStart !== false && $jsonEnd !== false) {
                $jsonString = substr($outputString, $jsonStart, $jsonEnd - $jsonStart);
                $result = json_decode($jsonString, true);
            } else {
                // Coba decode seluruh output
                $result = json_decode($outputString, true);
            }
            
            if (!$result || !isset($result['status'])) {
                Log::error('Invalid JSON output from Python: ' . $outputString);
                return response()->json([
                    'success' => false,
                    'message' => 'Format output tidak valid dari script Python. Output: ' . substr($outputString, 0, 200)
                ], 500);
            }
            
            if ($result['status'] === 'error') {
                return response()->json([
                    'success' => false,
                    'message' => $result['message']
                ], 400);
            }
            
            // Simpan hasil ke storage
            $this->saveAnalysisResults($result);
            
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'summary' => $result['summary'],
                'mrr' => $result['mrr'],
                'total_analyzed' => count($result['data'])
            ]);
            
        } catch (\Exception $e) {
            Log::error('Sentiment analysis error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get sentiment analysis results
     */
    public function getSentimentResults(Request $request)
    {
        try {
            $resultsPath = storage_path('app/sentiment_analysis/results.json');
            
            if (!file_exists($resultsPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hasil analisis tidak ditemukan.'
                ], 404);
            }
            
            $results = json_decode(file_get_contents($resultsPath), true);
            
            // Paginate results
            $page = $request->get('page', 1);
            $perPage = 10;
            $data = $results['data'] ?? [];
            
            // Calculate pagination
            $total = count($data);
            $offset = ($page - 1) * $perPage;
            $paginatedData = array_slice($data, $offset, $perPage);
            
            return response()->json([
                'success' => true,
                'data' => $paginatedData,
                'summary' => $results['summary'] ?? [],
                'mrr' => $results['mrr'] ?? 0,
                'pagination' => [
                    'current_page' => (int)$page,
                    'per_page' => $perPage,
                    'total' => $total,
                    'total_pages' => ceil($total / $perPage)
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error loading sentiment results: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat hasil analisis.'
            ], 500);
        }
    }

    /**
     * Save analysis results to storage
     */
    private function saveAnalysisResults($results)
    {
        try {
            $directory = storage_path('app/sentiment_analysis');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            $filePath = $directory . '/results.json';
            file_put_contents($filePath, json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            // Juga simpan summary ke database jika diperlukan
            if (isset($results['summary'])) {
                DB::table('sentiment_analysis_logs')->insert([
                    'total_feedback' => $results['summary']['total_feedback'] ?? 0,
                    'positive_count' => $results['summary']['sentiment_distribution']['positive'] ?? 0,
                    'negative_count' => $results['summary']['sentiment_distribution']['negative'] ?? 0,
                    'neutral_count' => $results['summary']['sentiment_distribution']['neutral'] ?? 0,
                    'mrr_score' => $results['mrr'] ?? 0,
                    'analysis_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            Log::info('Analysis results saved to: ' . $filePath);
            return true;
        } catch (\Exception $e) {
            Log::error('Error saving analysis results: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get sentiment statistics
     */
    public function getSentimentStats()
    {
        try {
            $resultsPath = storage_path('app/sentiment_analysis/results.json');
            
            if (!file_exists($resultsPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data analisis tidak ditemukan.'
                ], 404);
            }
            
            $results = json_decode(file_get_contents($resultsPath), true);
            
            // Hitung statistik
            $data = $results['data'] ?? [];
            $sentiments = array_column($data, 'sentiment');
            
            $stats = [
                'total' => count($data),
                'positive' => 0,
                'negative' => 0,
                'neutral' => 0,
                'unknown' => 0,
                'no_review' => 0
            ];
            
            foreach ($sentiments as $sentiment) {
                if (isset($stats[$sentiment])) {
                    $stats[$sentiment]++;
                } else {
                    $stats['unknown']++;
                }
            }
            
            return response()->json([
                'success' => true,
                'stats' => $stats,
                'summary' => $results['summary'] ?? [],
                'mrr' => $results['mrr'] ?? 0
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error getting sentiment stats: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil statistik.'
            ], 500);
        }
    }

    /**
     * Get initials from name
     */
    private function getInitials($name)
    {
        $nameParts = explode(' ', $name);
        if (count($nameParts) >= 2) {
            return strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }

    /**
     * Generate stars HTML for rating
     */
    public function generateStars($rating)
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="far fa-star text-muted"></i>';
            }
        }
        return $stars;
    }

    /**
     * Test Python connection
     */
    public function testPythonConnection()
    {
        try {
            $pythonExecutable = base_path('scripts/venv/Scripts/python.exe');
            
            if (!file_exists($pythonExecutable)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Python executable tidak ditemukan'
                ]);
            }
            
            $command = escapeshellcmd("\"{$pythonExecutable}\" --version 2>&1");
            $output = shell_exec($command);
            
            return response()->json([
                'success' => true,
                'message' => 'Python ditemukan',
                'version' => trim($output)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }
}