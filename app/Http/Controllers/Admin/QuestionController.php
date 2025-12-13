<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $validated['quiz_id'] = $quiz->id;

        QuizQuestion::create($validated);

        return redirect()->route('admin.quizzes.show', $quiz)
            ->with('success', 'Question created successfully!');
    }

    public function edit(QuizQuestion $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, QuizQuestion $question)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'options' => 'required|array|min:2|max:4',
            'options.*' => 'required|string',
            'correct_answer' => 'required|integer|min:0|max:3',
            'explanation' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        $question->update($validated);

        return redirect()->route('admin.quizzes.show', $question->quiz_id)
            ->with('success', 'Question updated successfully!');
    }

    public function destroy(QuizQuestion $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('admin.quizzes.show', $quizId)
            ->with('success', 'Question deleted successfully!');
    }
}