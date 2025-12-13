<?php
// routes/web.php (COMPLETE & FIXED)

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
// DASHBOARD REDIRECT (based on role)
// ================================================================

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

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
    Route::get('/chapters/{chapter}', [UserChapter::class, 'show'])->name('chapters.show');
    Route::post('/chapters/{chapter}/complete', [UserChapter::class, 'complete'])->name('chapters.complete');
    Route::post('/chapters/{chapter}/uncomplete', [UserChapter::class, 'uncomplete'])->name('chapters.uncomplete');
    
    // Quizzes
    Route::get('/quizzes/{quiz}', [UserQuiz::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [UserQuiz::class, 'submit'])->name('quizzes.submit');
    Route::get('/quizzes/{quiz}/results/{attempt}', [UserQuiz::class, 'results'])->name('quizzes.results');
    
    // Profile (FIX: Change prefix to avoid conflict)
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================================================================
// ADMIN ROUTES (Admin Only)
// ================================================================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Modules CRUD
    Route::resource('modules', AdminModule::class);
    Route::post('/modules/{module}/toggle', [AdminModule::class, 'toggle'])->name('modules.toggle');
    
    // Chapters CRUD
    Route::resource('chapters', AdminChapter::class);
    Route::post('/chapters/{chapter}/toggle', [AdminChapter::class, 'toggle'])->name('chapters.toggle');
    
    // Quizzes CRUD
    Route::resource('quizzes', AdminQuiz::class);
    Route::post('/quizzes/{quiz}/toggle', [AdminQuiz::class, 'toggle'])->name('quizzes.toggle');
    
    // Questions CRUD (nested under quiz)
    Route::get('/quizzes/{quiz}/questions/create', [AdminQuestion::class, 'create'])->name('questions.create');
    Route::post('/quizzes/{quiz}/questions', [AdminQuestion::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [AdminQuestion::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [AdminQuestion::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [AdminQuestion::class, 'destroy'])->name('questions.destroy');
    
    // Users CRUD
    Route::resource('users', AdminUser::class);

    // // Admin toggles
    // Route::post('/admin/modules/{module}/toggle', [ModuleController::class, 'toggle']);
    // Route::post('/admin/chapters/{chapter}/toggle', [ChapterController::class, 'toggle']);
    // Route::post('/admin/quizzes/{quiz}/toggle', [QuizController::class, 'toggle']);

    // // User settings
    // Route::get('/user/settings', [UserSettingsController::class, 'show']);
    // Route::patch('/user/settings', [UserSettingsController::class, 'update']);
    // Route::delete('/user/settings', [UserSettingsController::class, 'destroy']);

});