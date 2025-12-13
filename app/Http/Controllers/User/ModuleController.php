<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Module;

class ModuleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $modules = Module::with('chapters')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function($module) use ($user) {
                $module->progress_percentage = $user->getModuleProgress($module->id);
                $module->total_chapters = $module->chapters->count();
                $module->completed_chapters = $user->progress()
                    ->whereHas('chapter', function($query) use ($module) {
                        $query->where('module_id', $module->id);
                    })
                    ->where('completed', true)
                    ->count();
                return $module;
            });

        return view('user.modules.index', compact('modules'));
    }

    public function show(Module $module)
    {
        $user = auth()->user();
        
        // Load chapters with user progress
        $chapters = $module->chapters()
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function($chapter) use ($user) {
                $chapter->is_completed = $chapter->isCompletedBy($user->id);
                return $chapter;
            });

        // Load quizzes
        $quizzes = $module->quizzes()
            ->where('is_active', true)
            ->get()
            ->map(function($quiz) use ($user) {
                $quiz->best_attempt = $quiz->getUserBestAttempt($user->id);
                $quiz->is_passed = $quiz->isPassedBy($user->id);
                return $quiz;
            });

        $progress_percentage = $user->getModuleProgress($module->id);

        return view('user.modules.show', compact('module', 'chapters', 'quizzes', 'progress_percentage'));
    }
}