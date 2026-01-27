@extends('layouts.admin')

@section('title', 'Quiz Details')
@section('page-title', $quiz->title)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Quizzes
        </a>
    </div>

    <div class="mb-6 flex flex-col md:flex-row gap-3">
        <a href="{{ route('admin.questions.create', $quiz) }}"
            class="inline-flex w-full md:w-auto justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Question
        </a>
        <a href="{{ route('admin.questions.drafts', $quiz) }}"
            class="inline-flex w-full md:w-auto justify-center items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            Add from Draft
        </a>
        <a href="{{ route('admin.questions.import', $quiz) }}"
            class="inline-flex w-full md:w-auto justify-center items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
            </svg>
            Import from Excel
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

    @if (session('import_results'))
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold mb-4">Import Results</h3>

            @php
                $results = session('import_results');
            @endphp

            <div class="space-y-3">
                @if ($results['success'] > 0)
                    <div class="flex items-start p-4 bg-green-50 border border-green-200 rounded-lg">
                        <svg class="w-5 h-5 text-green-600 mr-3 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-green-900">Successfully imported: {{ $results['success'] }}
                                question(s)</p>
                        </div>
                    </div>
                @endif

                @if ($results['failed'] > 0)
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start mb-2">
                            <svg class="w-5 h-5 text-red-600 mr-3 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-medium text-red-900">Failed to import: {{ $results['failed'] }} question(s)</p>
                        </div>

                        @if (!empty($results['errors']))
                            <div class="ml-8 mt-3">
                                <p class="text-sm font-medium text-red-800 mb-2">Errors:</p>
                                <ul class="list-disc list-inside space-y-1 text-sm text-red-700">
                                    @foreach ($results['errors'] as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-lg font-bold">Questions</h2>
        </div>
        <div class="divide-y">
            @forelse($quiz->questions as $question)
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <p class="font-medium">{{ $loop->iteration }}. {{ $question->question }}</p>
                                @if ($question->is_draft)
                                    <span
                                        class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">DRAFT</span>
                                @endif
                            </div>

                            @if ($question->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $question->image) }}" alt="Question image"
                                        class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                </div>
                            @endif

                            <div class="space-y-1">
                                @foreach ($question->options as $index => $option)
                                    <div class="flex items-center">
                                        <span
                                            class="w-6 h-6 flex items-center justify-center rounded-full text-sm {{ $index == $question->correct_answer ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ chr(65 + $index) }}
                                        </span>
                                        <span class="ml-2 text-sm">{{ $option }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ml-4 flex space-x-2">
                            <a href="{{ route('admin.questions.edit', $question) }}"
                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure?')">
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
