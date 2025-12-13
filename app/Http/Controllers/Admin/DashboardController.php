<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Module;
use App\Models\Chapter;
use App\Models\Quiz;
use App\Models\QuizAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_modules' => Module::count(),
            'total_chapters' => Chapter::count(),
            'total_quizzes' => Quiz::count(),
            'total_quiz_attempts' => QuizAttempt::count(),
        ];

        $recent_users = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        $recent_attempts = QuizAttempt::with(['user', 'quiz'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_attempts'));
    }
}