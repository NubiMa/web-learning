@extends('layouts.user')

@section('title', $module->title)

@section('content')
    <!-- Module Header -->
    <div class="bg-white rounded-lg shadow p-6 md:p-8 mb-6 md:mb-8">
        <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left">
            <!-- Icon -->
            <div class="mb-4 md:mb-0 md:mr-8">
                <i class="devicon-{{ $module->icon }}-plain colored text-8xl md:text-9xl"></i>
            </div>

            <div class="flex-1 w-full">
                <h1 class="text-3xl md:text-4xl font-bold mb-3 text-gray-900">{{ $module->title }}</h1>
                <p class="text-gray-600 text-base md:text-lg mb-6 leading-relaxed">{{ $module->description }}</p>

                <div
                    class="flex flex-wrap justify-center md:justify-start gap-4 md:gap-6 text-sm text-gray-600 mb-6 bg-gray-50 md:bg-transparent p-4 md:p-0 rounded-lg md:rounded-none">
                    <span class="flex items-center"><span class="mr-2">📚</span> {{ $chapters->count() }} Chapters</span>
                    <span class="flex items-center"><span class="mr-2">✅</span>
                        {{ $chapters->where('is_completed', true)->count() }} Completed</span>
                    <span class="flex items-center"><span class="mr-2">📝</span> {{ $quizzes->count() }} Quizzes</span>
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between text-sm font-medium text-gray-700">
                        <span>Your Progress</span>
                        <span class="text-blue-600">{{ $progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="bg-blue-600 h-3 rounded-full transition-all duration-500 ease-out"
                            style="width: {{ $progress_percentage }}%"></div>
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
            @foreach ($chapters as $chapter)
                <a href="{{ route('user.chapters.show', $chapter->id) }}" class="block p-6 hover:bg-gray-50 transition">
                    <div class="flex items-center">
                        <div
                            class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full {{ $chapter->is_completed ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                            @if ($chapter->is_completed)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
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
    @if ($quizzes->count() > 0)
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-2xl font-bold">Quizzes</h2>
            </div>
            <div class="divide-y">
                @foreach ($quizzes as $quiz)
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row items-center md:items-center justify-between gap-4">
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="font-bold text-lg mb-1 text-gray-900">{{ $quiz->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">{{ $quiz->description }}</p>
                                <div
                                    class="flex flex-wrap justify-center md:justify-start items-center gap-3 text-sm text-gray-600">
                                    <span class="bg-gray-100 px-2 py-1 rounded">📝 {{ $quiz->questions->count() }}
                                        questions</span>
                                    <span class="bg-gray-100 px-2 py-1 rounded">🎯 Pass: {{ $quiz->passing_score }}%</span>
                                    @if ($quiz->best_attempt)
                                        <span
                                            class="px-3 py-1 rounded-full {{ $quiz->is_passed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            Best: {{ $quiz->best_attempt->score }}%
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full md:w-auto">
                                <a href="{{ route('user.quizzes.show', $quiz->id) }}"
                                    class="block w-full md:w-auto text-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-sm hover:shadow">
                                    {{ $quiz->best_attempt ? 'Retake Quiz' : 'Start Quiz' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
