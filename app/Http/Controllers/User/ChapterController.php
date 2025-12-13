<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProgress;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        
        $user = auth()->user();
        
        // Load module
        $chapter->load('module');
        
        // Check if completed
        $progress = UserProgress::firstOrCreate([
            'user_id' => $user->id,
            'chapter_id' => $chapter->id,
        ]);

        // Get next and previous chapters
        $next_chapter = $chapter->getNextChapter();
        $previous_chapter = $chapter->getPreviousChapter();

        // Module progress
        $module_progress = $user->getModuleProgress($chapter->module_id);

        return view('user.chapters.show', compact(
            'chapter', 
            'progress', 
            'next_chapter', 
            'previous_chapter',
            'module_progress'
        ));
    }

    public function complete(Chapter $chapter)
    {
        $user = auth()->user();
        
        $progress = UserProgress::firstOrCreate([
            'user_id' => $user->id,
            'chapter_id' => $chapter->id,
        ]);

        if (!$progress->completed) {
            $progress->markAsCompleted();
        }

        return back()->with('success', 'Chapter marked as completed!');
    }

    public function uncomplete(Chapter $chapter)
    {
        $user = auth()->user();
        
        $progress = UserProgress::where('user_id', $user->id)
            ->where('chapter_id', $chapter->id)
            ->first();

        if ($progress) {
            $progress->update([
                'completed' => false,
                'completed_at' => null,
            ]);
        }

        return back()->with('success', 'Chapter marked as incomplete!');
    }
}
