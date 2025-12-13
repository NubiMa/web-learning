<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'score',
        'correct_answers',
        'total_questions',
        'answers',
        'passed',
    ];

    protected $casts = [
        'answers' => 'array',
        'passed' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Calculate and save score
    public static function createAttempt($userId, $quizId, $userAnswers)
    {
        $quiz = Quiz::with('questions')->findOrFail($quizId);
        $correctAnswers = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $index => $question) {
            if (isset($userAnswers[$question->id])) {
                if ($question->isCorrectAnswer($userAnswers[$question->id])) {
                    $correctAnswers++;
                }
            }
        }

        $score = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100) : 0;
        $passed = $score >= $quiz->passing_score;

        return self::create([
            'user_id' => $userId,
            'quiz_id' => $quizId,
            'score' => $score,
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'answers' => $userAnswers,
            'passed' => $passed,
        ]);
    }
}
