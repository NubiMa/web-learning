@extends('layouts.user')

@section('title', $quiz->title)

@section('content')
<!-- Breadcrumb -->
<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm">
        <li><a href="{{ route('user.modules.index') }}" class="text-blue-600 hover:underline">Modules</a></li>
        <li>/</li>
        <li><a href="{{ route('user.modules.show', $quiz->module->slug) }}" class="text-blue-600 hover:underline">{{ $quiz->module->title }}</a></li>
        <li>/</li>
        <li class="text-gray-600">{{ $quiz->title }}</li>
    </ol>
</nav>

<!-- Quiz Info -->
<div class="bg-white rounded-lg shadow p-8 mb-8">
    <h1 class="text-3xl font-bold mb-4">{{ $quiz->title }}</h1>
    
    @if($quiz->description)
    <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Questions</p>
                <p class="text-xl font-bold">{{ $quiz->questions->count() }}</p>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Passing Score</p>
                <p class="text-xl font-bold">{{ $quiz->passing_score }}%</p>
            </div>
        </div>

        @if($best_attempt)
        <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center mr-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-600">Your Best</p>
                <p class="text-xl font-bold">{{ $best_attempt->score }}%</p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Quiz Form -->
<form action="{{ route('user.quizzes.submit', $quiz->id) }}" method="POST" id="quizForm">
    @csrf
    <div class="space-y-6 mb-8">
        @foreach($quiz->questions as $question)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-medium text-lg mb-4">{{ $loop->iteration }}. {{ $question->question }}</h3>
            
            @if($question->image)
            <div class="mb-4">
                <img src="{{ asset('storage/' . $question->image) }}" alt="Question image" class="max-w-full h-auto rounded-lg border border-gray-200">
            </div>
            @endif
            
            <div class="space-y-3">
                @foreach($question->options as $index => $option)
                <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                    <input type="radio" name="answers[{{ $question->id }}]" value="{{ $index }}" required class="w-5 h-5 text-blue-600">
                    <span class="ml-3 flex-1">{{ chr(65 + $index) }}. {{ $option }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center">
            <a href="{{ route('user.modules.show', $quiz->module->slug) }}" class="text-gray-600 hover:text-gray-900">← Back to Module</a>
            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                Submit Quiz
            </button>
        </div>
    </div>
</form>

<!-- Previous Attempts -->
@if($attempts->count() > 0)
<div class="mt-8 bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h2 class="text-xl font-bold">Your Previous Attempts</h2>
    </div>
    <div class="divide-y">
        @foreach($attempts as $attempt)
        <div class="p-6 flex items-center justify-between">
            <div>
                <p class="font-medium">{{ $attempt->created_at->format('M d, Y - H:i') }}</p>
                <p class="text-sm text-gray-600">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }} correct</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $attempt->score }}%
                </span>
                <a href="{{ route('user.quizzes.results', [$quiz->id, $attempt->id]) }}" class="text-blue-600 hover:text-blue-900">View Details</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@push('scripts')
<script>
    // Confirm before submit
    document.getElementById('quizForm').addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to submit? Make sure you have answered all questions.')) {
            e.preventDefault();
        }
    });
</script>
@endpush
@endsection