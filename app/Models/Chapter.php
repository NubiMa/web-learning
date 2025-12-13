<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'content',
        'code_example',
        'explanation',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($chapter) {
            if (empty($chapter->slug)) {
                $chapter->slug = Str::slug($chapter->title);
            }
        });
    }

    // Relationships
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    // Check if user completed this chapter
    public function isCompletedBy($userId)
    {
        return $this->userProgress()
            ->where('user_id', $userId)
            ->where('completed', true)
            ->exists();
    }

    // Get next chapter
    public function getNextChapter()
    {
        return Chapter::where('module_id', $this->module_id)
            ->where('order', '>', $this->order)
            ->orderBy('order')
            ->first();
    }

    // Get previous chapter
    public function getPreviousChapter()
    {
        return Chapter::where('module_id', $this->module_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'desc')
            ->first();
    }
}
