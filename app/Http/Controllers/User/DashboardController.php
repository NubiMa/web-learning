<?php
// app/Http/Controllers/User/DashboardController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\QuizAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get all modules with progress
        $modules = Module::with('chapters')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function($module) use ($user) {
                $module->progress_percentage = $user->getModuleProgress($module->id);
                return $module;
            });

        // Recent quiz attempts
        $recent_attempts = QuizAttempt::with('quiz.module')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Statistics
        $stats = [
            'total_completed' => $user->progress()->where('completed', true)->count(),
            'total_quizzes_taken' => $user->quizAttempts()->count(),
            'average_score' => $user->quizAttempts()->avg('score') ?? 0,
            'quizzes_passed' => $user->quizAttempts()->where('passed', true)->count(),
        ];

        return view('user.dashboard', compact('modules', 'recent_attempts', 'stats'));
    }
}