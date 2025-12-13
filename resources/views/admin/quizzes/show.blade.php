@extends('layouts.admin')

@section('title', 'Quiz Details')
@section('page-title', $quiz->title)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.questions.create', $quiz) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Question
    </a>
</div>

<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm text-gray-600">Module</p>
            <p class="font-medium">{{ $quiz->module->title }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Passing Score</p>
            <p class="font-medium">{{ $quiz->passing_score }}%</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Total Questions</p>
            <p class="font-medium">{{ $quiz->questions->count() }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Time Limit</p>
            <p class="font-medium">{{ $quiz->time_limit ? $quiz->time_limit . ' minutes' : 'Unlimited' }}</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b">
        <h2 class="text-lg font-bold">Questions</h2>
    </div>
    <div class="divide-y">
        @forelse($quiz->questions as $question)
        <div class="p-6">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <p class="font-medium mb-2">{{ $loop->iteration }}. {{ $question->question }}</p>
                    <div class="space-y-1">
                        @foreach($question->options as $index => $option)
                        <div class="flex items-center">
                            <span class="w-6 h-6 flex items-center justify-center rounded-full text-sm {{ $index == $question->correct_answer ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ chr(65 + $index) }}
                            </span>
                            <span class="ml-2 text-sm">{{ $option }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="ml-4 flex space-x-2">
                    <a href="{{ route('admin.questions.edit', $question) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            No questions yet. Add your first question.
        </div>
        @endforelse
    </div>
</div>
@endsection