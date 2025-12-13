<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Relationships
    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    // Get completed chapters
    public function completedChapters()
    {
        return $this->belongsToMany(Chapter::class, 'user_progress')
            ->wherePivot('completed', true)
            ->withPivot('completed_at')
            ->withTimestamps();
    }

    // Calculate module progress
    public function getModuleProgress($moduleId)
    {
        $totalChapters = Chapter::where('module_id', $moduleId)->count();
        if ($totalChapters === 0) return 0;

        $completedChapters = $this->progress()
            ->whereHas('chapter', function($query) use ($moduleId) {
                $query->where('module_id', $moduleId);
            })
            ->where('completed', true)
            ->count();

        return round(($completedChapters / $totalChapters) * 100);
    }
}
