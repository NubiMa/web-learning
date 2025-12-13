<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ModuleController as AdminModule;
use App\Http\Controllers\Admin\ChapterController as AdminChapter;
use App\Http\Controllers\Admin\QuizController as AdminQuiz;
use App\Http\Controllers\Admin\QuestionController as AdminQuestion;
use App\Http\Controllers\Admin\UserController as AdminUser;

// User Controllers
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\ModuleController as UserModule;
use App\Http\Controllers\User\ChapterController as UserChapter;
use App\Http\Controllers\User\QuizController as UserQuiz;

// ================================================================
// PUBLIC ROUTES
// ================================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

// ================================================================
// AUTH ROUTES (dari Laravel Breeze)
// ================================================================

require __DIR__.'/auth.php';

// ================================================================
// USER ROUTES (Authenticated Users)
// ================================================================

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    
    // Modules
    Route::get('/modules', [UserModule::class, 'index'])->name('modules.index');
    Route::get('/modules/{module:slug}', [UserModule::class, 'show'])->name('modules.show');
    
    // Chapters
    Route::get('/chapters/{chapter:id}', [UserChapter::class, 'show'])->name('chapters.show');
    Route::post('/chapters/{chapter:id}/complete', [UserChapter::class, 'complete'])->name('chapters.complete');
    Route::post('/chapters/{chapter:id}/uncomplete', [UserChapter::class, 'uncomplete'])->name('chapters.uncomplete');
    
    // Quizzes
    Route::get('/quizzes/{quiz:id}', [UserQuiz::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz:id}/submit', [UserQuiz::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz:id}/results/{attempt:id}', [UserQuiz::class, 'results'])->name('quizzes.results');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================================================================
// ADMIN ROUTES (Admin Only)
// ================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Modules CRUD
    Route::resource('modules', AdminModule::class);
    
    // Chapters CRUD
    Route::resource('chapters', AdminChapter::class);
    
    // Quizzes CRUD
    Route::resource('quizzes', AdminQuiz::class);
    
    // Questions CRUD (nested under quiz)
    Route::get('/quizzes/{quiz}/questions/create', [AdminQuestion::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quiz}/questions', [AdminQuestion::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [AdminQuestion::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [AdminQuestion::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [AdminQuestion::class, 'destroy'])->name('questions.destroy');
    
    // Users CRUD
    Route::resource('users', AdminUser::class);
    
    // Quick actions
    Route::post('/modules/{module}/toggle', [AdminModule::class, 'toggle'])->name('modules.toggle');
    Route::post('/chapters/{chapter}/toggle', [AdminChapter::class, 'toggle'])->name('chapters.toggle');
    Route::post('/quizzes/{quiz}/toggle', [AdminQuiz::class, 'toggle'])->name('quizzes.toggle');
});

// ================================================================
// Redirect based on role after login
// ================================================================

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

// Profile Routes (ADD THIS)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');