<?php
// app/Models/Chapter.php (FIXED)

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
        
        // AUTO-GENERATE UNIQUE SLUG
        static::creating(function ($chapter) {
            if (empty($chapter->slug)) {
                $slug = Str::slug($chapter->title);
                $originalSlug = $slug;
                $count = 1;
                
                // Check if slug exists in the same module
                while (static::where('module_id', $chapter->module_id)
                    ->where('slug', $slug)
                    ->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }
                
                $chapter->slug = $slug;
            }
        });
        
        // ALSO HANDLE UPDATING
        static::updating(function ($chapter) {
            if ($chapter->isDirty('title') && empty($chapter->slug)) {
                $slug = Str::slug($chapter->title);
                $originalSlug = $slug;
                $count = 1;
                
                while (static::where('module_id', $chapter->module_id)
                    ->where('slug', $slug)
                    ->where('id', '!=', $chapter->id)
                    ->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }
                
                $chapter->slug = $slug;
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
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
    }

    // Get previous chapter
    public function getPreviousChapter()
    {
        return Chapter::where('module_id', $this->module_id)
            ->where('order', '<', $this->order)
            ->where('is_active', true)
            ->orderBy('order', 'desc')
            ->first();
    }
}