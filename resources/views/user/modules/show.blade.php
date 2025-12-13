@extends('layouts.user')

@section('title', $module->title)

@section('content')
<!-- Module Header -->
<div class="bg-white rounded-lg shadow p-8 mb-8">
    <div class="flex items-start">
        <span class="text-6xl mr-6">{{ $module->icon }}</span>
        <div class="flex-1">
            <h1 class="text-4xl font-bold mb-3">{{ $module->title }}</h1>
            <p class="text-gray-600 text-lg mb-6">{{ $module->description }}</p>
            
            <div class="flex items-center space-x-6 text-sm text-gray-600 mb-6">
                <span>📚 {{ $chapters->count() }} Chapters</span>
                <span>✅ {{ $chapters->where('is_completed', true)->count() }} Completed</span>
                <span>📝 {{ $quizzes->count() }} Quizzes</span>
            </div>

            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span>Your Progress</span>
                    <span class="font-bold text-blue-600">{{ $progress_percentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all" style="width: {{ $progress_percentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chapters List -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="p-6 border-b">
        <h2 class="text-2xl font-bold">Chapters</h2>
    </div>
    <div class="divide-y">
        @foreach($chapters as $chapter)
        <a href="{{ route('user.chapters.show', $chapter->id) }}" class="block p-6 hover:bg-gray-50 transition">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full {{ $chapter->is_completed ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                    @if($chapter->is_completed)
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @else
                    <span class="font-bold">{{ $loop->iteration }}</span>
                    @endif
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="font-medium text-lg">{{ $chapter->title }}</h3>
                    <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($chapter->content), 100) }}</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Quizzes -->
@if($quizzes->count() > 0)
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h2 class="text-2xl font-bold">Quizzes</h2>
    </div>
    <div class="divide-y">
        @foreach($quizzes as $quiz)
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="font-medium text-lg mb-1">{{ $quiz->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">{{ $quiz->description }}</p>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <span>📝 {{ $quiz->questions->count() }} questions</span>
                        <span>🎯 Pass: {{ $quiz->passing_score }}%</span>
                        @if($quiz->best_attempt)
                        <span class="px-3 py-1 rounded-full {{ $quiz->is_passed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            Best: {{ $quiz->best_attempt->score }}%
                        </span>
                        @endif
                    </div>
                </div>
                <a href="{{ route('user.quizzes.show', $quiz->id) }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    {{ $quiz->best_attempt ? 'Retake' : 'Start' }} Quiz
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection