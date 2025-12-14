<?php
// app/Http/Controllers/User/ProgressController.php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Chapter;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display user's overall progress
     */
    public function index()
    {
        $user = auth()->user();
        
        // Get all modules with progress
        $modules = Module::with('chapters')
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function($module) use ($user) {
                $totalChapters = $module->chapters->count();
                $completedChapters = $user->progress()
                    ->whereHas('chapter', function($query) use ($module) {
                        $query->where('module_id', $module->id);
                    })
                    ->where('completed', true)
                    ->count();
                
                // Don't set $module->total_chapters (conflict with accessor)
                // Use dynamic property instead
                $module->setAttribute('completed_chapters_count', $completedChapters);
                $module->setAttribute('progress_percentage', $totalChapters > 0 
                    ? round(($completedChapters / $totalChapters) * 100) 
                    : 0);
                    
                return $module;
            });
        
        // Overall statistics
        $stats = [
            'total_chapters' => Chapter::where('is_active', true)->count(),
            'completed_chapters' => $user->progress()->where('completed', true)->count(),
            'total_quizzes_taken' => $user->quizAttempts()->count(),
            'quizzes_passed' => $user->quizAttempts()->where('passed', true)->count(),
            'average_score' => $user->quizAttempts()->avg('score') ?? 0,
        ];
        
        $stats['completion_percentage'] = $stats['total_chapters'] > 0
            ? round(($stats['completed_chapters'] / $stats['total_chapters']) * 100)
            : 0;
        
        // Recent activities
        $recent_completions = UserProgress::with('chapter.module')
            ->where('user_id', $user->id)
            ->where('completed', true)
            ->orderBy('completed_at', 'desc')
            ->take(10)
            ->get();
        
        return view('user.progress.index', compact('modules', 'stats', 'recent_completions'));
    }
    
    /**
     * Show progress for specific module
     */
    public function module(Module $module)
    {
        $user = auth()->user();
        
        // Get chapters with completion status
        $chapters = $module->chapters()
            ->where('is_active', true)
            ->orderBy('order')
            ->get()
            ->map(function($chapter) use ($user) {
                $progress = $user->progress()
                    ->where('chapter_id', $chapter->id)
                    ->first();
                    
                $chapter->completed = $progress ? $progress->completed : false;
                $chapter->completed_at = $progress ? $progress->completed_at : null;
                
                return $chapter;
            });
        
        $progress_percentage = $user->getModuleProgress($module->id);
        
        return view('user.progress.module', compact('module', 'chapters', 'progress_percentage'));
    }
    
    /**
     * Reset progress for a module (for retaking)
     */
    public function reset(Module $module)
    {
        $user = auth()->user();
        
        // Delete all progress for this module
        UserProgress::whereHas('chapter', function($query) use ($module) {
            $query->where('module_id', $module->id);
        })->where('user_id', $user->id)->delete();
        
        return back()->with('success', 'Progress has been reset for this module.');
    }
    
    /**
     * Export progress as JSON
     */
    public function export()
    {
        $user = auth()->user();
        
        $data = [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'exported_at' => now()->toDateTimeString(),
            'modules' => Module::with(['chapters' => function($query) use ($user) {
                $query->with(['userProgress' => function($q) use ($user) {
                    $q->where('user_id', $user->id);
                }]);
            }])->get()->map(function($module) use ($user) {
                return [
                    'title' => $module->title,
                    'progress' => $user->getModuleProgress($module->id),
                    'chapters' => $module->chapters->map(function($chapter) {
                        $progress = $chapter->userProgress->first();
                        return [
                            'title' => $chapter->title,
                            'completed' => $progress ? $progress->completed : false,
                            'completed_at' => $progress ? $progress->completed_at : null,
                        ];
                    }),
                ];
            }),
            'quizzes' => $user->quizAttempts()->with('quiz')->get()->map(function($attempt) {
                return [
                    'quiz' => $attempt->quiz->title,
                    'score' => $attempt->score,
                    'passed' => $attempt->passed,
                    'date' => $attempt->created_at->toDateTimeString(),
                ];
            }),
        ];
        
        return response()->json($data, 200, [], JSON_PRETTY_PRINT)
            ->header('Content-Disposition', 'attachment; filename="progress-' . now()->format('Y-m-d') . '.json"');
    }
}