@extends('layouts.admin')

@section('title', 'Add Question from Draft')
@section('page-title', 'Add Question from Draft to: ' . $quiz->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.show', $quiz) }}" class="text-blue-600 hover:text-blue-800">
            ← Back to Quiz
        </a>
    </div>

    @if($draftQuestions->count() > 0)
    <div class="grid gap-4">
        @foreach($draftQuestions as $draftQuestion)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-3">
                        <h3 class="font-medium text-lg">{{ $draftQuestion->question }}</h3>
                        <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">DRAFT</span>
                    </div>
                    
                    @if($draftQuestion->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $draftQuestion->image) }}" alt="Question image" class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                    </div>
                    @endif
                    
                    <div class="space-y-2 mb-3">
                        @foreach($draftQuestion->options as $index => $option)
                        <div class="flex items-center">
                            <span class="w-6 h-6 flex items-center justify-center rounded-full text-sm {{ $index == $draftQuestion->correct_answer ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ chr(65 + $index) }}
                            </span>
                            <span class="ml-2 text-sm">{{ $option }}</span>
                        </div>
                        @endforeach
                    </div>

                    @if($draftQuestion->explanation)
                    <p class="text-sm text-gray-600 mt-2"><strong>Explanation:</strong> {{ $draftQuestion->explanation }}</p>
                    @endif
                    
                    <p class="text-xs text-gray-500 mt-2">
                        From quiz: <span class="font-medium">{{ $draftQuestion->quiz->title }}</span>
                    </p>
                </div>
                
                <form action="{{ route('admin.questions.addDraft', [$quiz, $draftQuestion]) }}" method="POST" class="ml-4">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        Add to Quiz
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No Draft Questions Available</h3>
        <p class="text-gray-600 mb-6">Create questions and save them as drafts to add them here later.</p>
        <a href="{{ route('admin.questions.create', $quiz) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Create New Question
        </a>
    </div>
    @endif
</div>
@endsection
