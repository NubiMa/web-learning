@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
    <p class="text-gray-600">Continue your learning journey</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Completed</p>
                <p class="text-2xl font-bold">{{ $stats['total_completed'] }}</p>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Quizzes Taken</p>
                <p class="text-2xl font-bold">{{ $stats['total_quizzes_taken'] }}</p>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Average Score</p>
                <p class="text-2xl font-bold">{{ round($stats['average_score']) }}%</p>
            </div>
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Passed</p>
                <p class="text-2xl font-bold">{{ $stats['quizzes_passed'] }}</p>
            </div>
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Learning Modules -->
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Your Learning Modules</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($modules as $module)
        <a href="{{ route('user.modules.show', $module->slug) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition p-6">
            <div class="flex items-start">
                <span class="text-4xl mr-4">{{ $module->icon }}</span>
                <div class="flex-1">
                    <h3 class="text-xl font-bold mb-2">{{ $module->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($module->description, 100) }}</p>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Progress</span>
                            <span class="font-medium">{{ $module->progress_percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $module->progress_percentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Recent Quiz Attempts -->
@if($recent_attempts->count() > 0)
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h2 class="text-xl font-bold">Recent Quiz Attempts</h2>
    </div>
    <div class="divide-y">
        @foreach($recent_attempts as $attempt)
        <div class="p-6 flex items-center justify-between">
            <div>
                <p class="font-medium">{{ $attempt->quiz->title }}</p>
                <p class="text-sm text-gray-600">{{ $attempt->quiz->module->title }} - {{ $attempt->created_at->diffForHumans() }}</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $attempt->score }}%
                </span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection