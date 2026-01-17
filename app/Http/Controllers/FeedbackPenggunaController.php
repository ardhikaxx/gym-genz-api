<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

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
            
        return view('admins.feedback-pengguna.index', compact('feedbacks'));
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
}