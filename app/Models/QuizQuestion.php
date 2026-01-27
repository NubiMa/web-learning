<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question',
        'image',
        'options',
        'correct_answer',
        'explanation',
        'order',
        'is_draft',
    ];

    protected $casts = [
        'options' => 'array',
        'is_draft' => 'boolean',
    ];

    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_draft', false);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Check if answer is correct
    public function isCorrectAnswer($answerIndex)
    {
        return $answerIndex == $this->correct_answer;
    }
}
