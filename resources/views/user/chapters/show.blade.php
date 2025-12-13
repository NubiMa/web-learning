@extends('layouts.user')

@section('title', $chapter->title)

@section('content')
<!-- Breadcrumb -->
<nav class="mb-6">
    <ol class="flex items-center space-x-2 text-sm">
        <li><a href="{{ route('user.modules.index') }}" class="text-blue-600 hover:underline">Modules</a></li>
        <li>/</li>
        <li><a href="{{ route('user.modules.show', $chapter->module->slug) }}" class="text-blue-600 hover:underline">{{ $chapter->module->title }}</a></li>
        <li>/</li>
        <li class="text-gray-600">{{ $chapter->title }}</li>
    </ol>
</nav>

<!-- Chapter Content -->
<div class="bg-white rounded-lg shadow p-8 mb-6">
    <div class="flex items-start justify-between mb-6">
        <h1 class="text-3xl font-bold">{{ $chapter->title }}</h1>
        <form action="{{ $progress->completed ? route('user.chapters.uncomplete', $chapter->id) : route('user.chapters.complete', $chapter->id) }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center px-4 py-2 rounded-lg {{ $progress->completed ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} hover:bg-opacity-80 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ $progress->completed ? 'Completed' : 'Mark as Complete' }}
            </button>
        </form>
    </div>

    <div class="prose max-w-none mb-8">
        <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $chapter->content }}</p>
    </div>

    @if($chapter->code_example)
    <div class="mb-8">
        <h2 class="text-xl font-bold mb-3">Code Example</h2>
        <div class="bg-gray-900 rounded-lg p-6 overflow-x-auto">
            <pre class="text-sm text-gray-100"><code>{{ $chapter->code_example }}</code></pre>
        </div>
    </div>
    @endif

    @if($chapter->explanation)
    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
        <h3 class="font-bold mb-2">💡 Explanation</h3>
        <p class="text-gray-700">{{ $chapter->explanation }}</p>
    </div>
    @endif
</div>

<!-- Navigation -->
<div class="flex justify-between">
    @if($previous_chapter)
    <a href="{{ route('user.chapters.show', $previous_chapter->id) }}" class="flex items-center px-6 py-3 bg-white rounded-lg shadow hover:shadow-md transition">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Previous
    </a>
    @else
    <div></div>
    @endif

    @if($next_chapter)
    <a href="{{ route('user.chapters.show', $next_chapter->id) }}" class="flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
        Next
        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </a>
    @else
    <a href="{{ route('user.modules.show', $chapter->module->slug) }}" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        Back to Module
    </a>
    @endif
</div>
@endsection