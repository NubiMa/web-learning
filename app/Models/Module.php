<?php
// app/Models/Module.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($module) {
            if (empty($module->slug)) {
                $module->slug = Str::slug($module->title);
            }
        });
    }

    // Relationships
    public function chapters()
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    // REMOVED: getTotalChaptersAttribute() 
    // Karena conflict dengan property yang di-set manual di controller
    // Sekarang gunakan method biasa atau langsung $module->chapters()->count()
}