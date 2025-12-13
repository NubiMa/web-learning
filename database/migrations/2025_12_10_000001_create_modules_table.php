<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // HTML, CSS, JavaScript, PHP
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('icon')->nullable(); // emoji atau icon class
            $table->string('color')->default('blue'); // untuk UI
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
