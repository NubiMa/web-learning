<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Module;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['module', 'questions'])->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.quizzes.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            'time_limit' => 'nullable|integer|min:1',
        ]);

        $validated['is_active'] = true;

        Quiz::create($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz created successfully!');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load(['module', 'questions' => function($query) {
            $query->orderBy('order');
        }]);

        return view('admin.quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.quizzes.edit', compact('quiz', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            'time_limit' => 'nullable|integer|min:1',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz deleted successfully!');
    }

    public function toggle(Quiz $quiz)
    {
        $quiz->update(['is_active' => !$quiz->is_active]);

        return back()->with('success', 'Quiz status updated!');
    }
}