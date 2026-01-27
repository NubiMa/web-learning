<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $user = auth()->user();
        
        // Load published questions only
        $quiz->load(['questions' => function($query) {
            $query->published()->orderBy('order');
        }, 'module']);

        // Get user's attempts
        $attempts = QuizAttempt::where('user_id', $user->id)
            ->where('quiz_id', $quiz->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $best_attempt = $attempts->sortByDesc('score')->first();

        return view('user.quizzes.show', compact('quiz', 'attempts', 'best_attempt'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $user = auth()->user();
        $answers = $request->input('answers');

        // Create quiz attempt and calculate score
        $attempt = QuizAttempt::createAttempt($user->id, $quiz->id, $answers);

        return redirect()->route('user.quizzes.results', [
            'quiz' => $quiz->id,
            'attempt' => $attempt->id
        ])->with('success', 'Quiz submitted successfully!');
    }

    public function results(Quiz $quiz, QuizAttempt $attempt)
    {
        // Make sure this attempt belongs to current user
        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        // Load quiz with published questions only
        $quiz->load(['questions' => function($query) {
            $query->published()->orderBy('order');
        }, 'module']);

        // Get user answers
        $user_answers = $attempt->answers;

        // Prepare results with correct answers
        $results = $quiz->questions->map(function($question) use ($user_answers) {
            $user_answer = $user_answers[$question->id] ?? null;
            
            return [
                'question' => $question,
                'user_answer' => $user_answer,
                'is_correct' => $user_answer !== null && $question->isCorrectAnswer($user_answer),
            ];
        });

        return view('user.quizzes.results', compact('quiz', 'attempt', 'results'));
    }
}