@extends('layouts.user')

@section('title', 'Quiz Results')

@section('content')
<!-- Breadcrumb -->
<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm">
        <li><a href="{{ route('user.modules.index') }}" class="text-blue-600 hover:underline">Modules</a></li>
        <li>/</li>
        <li><a href="{{ route('user.modules.show', $quiz->module->slug) }}" class="text-blue-600 hover:underline">{{ $quiz->module->title }}</a></li>
        <li>/</li>
        <li><a href="{{ route('user.quizzes.show', $quiz->id) }}" class="text-blue-600 hover:underline">{{ $quiz->title }}</a></li>
        <li>/</li>
        <li class="text-gray-600">Results</li>
    </ol>
</nav>

<!-- Results Summary -->
<div class="bg-white rounded-lg shadow p-8 mb-8 text-center">
    <div class="mb-6">
        @if($attempt->passed)
        <div class="w-20 h-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-green-600 mb-2">Congratulations! 🎉</h1>
        <p class="text-gray-600">You passed the quiz!</p>
        @else
        <div class="w-20 h-20 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-red-600 mb-2">Keep Trying!</h1>
        <p class="text-gray-600">You need {{ $quiz->passing_score }}% to pass</p>
        @endif
    </div>

    <div class="text-6xl font-bold mb-4 {{ $attempt->passed ? 'text-green-600' : 'text-red-600' }}">
        {{ $attempt->score }}%
    </div>

    <div class="flex justify-center space-x-8 text-sm">
        <div>
            <p class="text-gray-600">Correct Answers</p>
            <p class="text-2xl font-bold">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</p>
        </div>
        <div>
            <p class="text-gray-600">Passing Score</p>
            <p class="text-2xl font-bold">{{ $quiz->passing_score }}%</p>
        </div>
    </div>

    <div class="mt-8 space-x-4">
        <a href="{{ route('user.quizzes.show', $quiz->id) }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Retake Quiz
        </a>
        <a href="{{ route('user.modules.show', $quiz->module->slug) }}" class="inline-block px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
            Back to Module
        </a>
    </div>
</div>

<!-- Answer Review -->
<div class="space-y-6">
    @foreach($results as $index => $result)
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-start justify-between mb-4">
            <h3 class="font-medium text-lg flex-1">{{ $index + 1 }}. {{ $result['question']->question }}</h3>
            <span class="ml-4 px-3 py-1 rounded-full text-sm font-medium {{ $result['is_correct'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $result['is_correct'] ? 'Correct' : 'Wrong' }}
            </span>
        </div>

        @if($result['question']->image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $result['question']->image) }}" alt="Question image" class="max-w-full h-auto rounded-lg border border-gray-200">
        </div>
        @endif

        <div class="space-y-2">
            @foreach($result['question']->options as $optIndex => $option)
            <div class="flex items-center p-3 rounded-lg {{ $optIndex == $result['question']->correct_answer ? 'bg-green-50 border border-green-200' : ($optIndex == $result['user_answer'] && !$result['is_correct'] ? 'bg-red-50 border border-red-200' : 'bg-gray-50') }}">
                <span class="w-6 h-6 flex items-center justify-center rounded-full text-sm mr-3 {{ $optIndex == $result['question']->correct_answer ? 'bg-green-500 text-white' : ($optIndex == $result['user_answer'] ? 'bg-red-500 text-white' : 'bg-gray-300 text-gray-700') }}">
                    {{ chr(65 + $optIndex) }}
                </span>
                <span class="flex-1">{{ $option }}</span>
                @if($optIndex == $result['question']->correct_answer)
                <span class="text-green-600 text-sm font-medium">✓ Correct Answer</span>
                @elseif($optIndex == $result['user_answer'] && !$result['is_correct'])
                <span class="text-red-600 text-sm font-medium">✗ Your Answer</span>
                @endif
            </div>
            @endforeach
        </div>

        @if($result['question']->explanation)
        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm font-medium text-blue-900 mb-1">💡 Explanation:</p>
            <p class="text-sm text-blue-800">{{ $result['question']->explanation }}</p>
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection
