<?php

namespace App\Http\Controllers;

use App\Models\JadwalWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ManajemenJadwalController extends Controller
{
    /**
     * Display a listing of the jadwal workouts.
     */
    public function index()
    {
        $jadwals = JadwalWorkout::orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->paginate(10);
        
        return view('admins.manajemen-jadwal-workout.index', compact('jadwals'));
    }

    /**
     * Store a newly created jadwal workout in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jadwal' => 'required|string|max:255',
            'kategori_jadwal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'durasi_workout' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'nama_jadwal' => $request->nama_jadwal,
                'kategori_jadwal' => $request->kategori_jadwal,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'durasi_workout' => $request->durasi_workout,
            ];

            $jadwal = JadwalWorkout::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal workout berhasil ditambahkan!',
                'data' => $jadwal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified jadwal workout.
     */
    public function show($id)
    {
        $jadwal = JadwalWorkout::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $jadwal
        ]);
    }

    /**
     * Update the specified jadwal workout in storage.
     */
    public function update(Request $request, $id)
    {
        $jadwal = JadwalWorkout::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_jadwal' => 'required|string|max:255',
            'kategori_jadwal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'durasi_workout' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = [
                'nama_jadwal' => $request->nama_jadwal,
                'kategori_jadwal' => $request->kategori_jadwal,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
                'durasi_workout' => $request->durasi_workout,
            ];

            $jadwal->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal workout berhasil diperbarui!',
                'data' => $jadwal
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified jadwal workout from storage.
     */
    public function destroy($id)
    {
        try {
            $jadwal = JadwalWorkout::findOrFail($id);
            $jadwal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal workout berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get upcoming schedules
     */
    public function getUpcoming()
    {
        $today = Carbon::now()->format('Y-m-d');
        
        $upcoming = JadwalWorkout::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->limit(5)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $upcoming
        ]);
    }

    /**
     * Get unique categories
     */
    public function getCategories()
    {
        $categories = JadwalWorkout::select('kategori_jadwal')
            ->distinct()
            ->pluck('kategori_jadwal')
            ->toArray();
        
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * Get schedule status based on date and time
     */
    private function getScheduleStatus($date, $time)
    {
        $now = Carbon::now();
        $scheduleDateTime = Carbon::parse($date . ' ' . $time);
        
        if ($scheduleDateTime->isPast()) {
            return 'completed';
        } elseif ($scheduleDateTime->isToday()) {
            return 'today';
        } elseif ($scheduleDateTime->isTomorrow()) {
            return 'tomorrow';
        } else {
            return 'upcoming';
        }
    }

    /**
     * Format date for display
     */
    private function formatDate($date)
    {
        $carbonDate = Carbon::parse($date);
        
        if ($carbonDate->isToday()) {
            return 'Hari ini';
        } elseif ($carbonDate->isTomorrow()) {
            return 'Besok';
        } elseif ($carbonDate->isYesterday()) {
            return 'Kemarin';
        } else {
            return $carbonDate->translatedFormat('d M Y');
        }
    }

    /**
     * Format time for display
     */
    private function formatTime($time)
    {
        return Carbon::parse($time)->format('H:i');
    }
}