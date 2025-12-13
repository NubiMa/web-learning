@extends('layouts.admin')

@section('title', $chapter->title)
@section('page-title', 'Chapter: ' . $chapter->title)

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.chapters.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Chapters
    </a>
    <div class="flex space-x-3">
        <form action="{{ route('admin.chapters.toggle', $chapter) }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 border {{ $chapter->is_active ? 'border-red-300 text-red-600 hover:bg-red-50' : 'border-green-300 text-green-600 hover:bg-green-50' }} rounded-lg">
                {{ $chapter->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
        <a href="{{ route('admin.chapters.edit', $chapter) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Edit Chapter
        </a>
    </div>
</div>

<!-- Chapter Info -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                {{ $chapter->module->title }}
            </span>
            <span class="ml-2 px-3 py-1 rounded-full text-sm {{ $chapter->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $chapter->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <span class="text-sm text-gray-600">Order: {{ $chapter->order }}</span>
    </div>

    <h2 class="text-2xl font-bold mb-4">{{ $chapter->title }}</h2>

    <div class="prose max-w-none mb-6">
        <h3 class="text-lg font-bold mb-2">Content</h3>
        <p class="text-gray-700 whitespace-pre-line">{{ $chapter->content }}</p>
    </div>

    @if($chapter->code_example)
    <div class="mb-6">
        <h3 class="text-lg font-bold mb-2">Code Example</h3>
        <div class="bg-gray-900 rounded-lg p-4 overflow-x-auto">
            <pre class="text-sm text-gray-100"><code>{{ $chapter->code_example }}</code></pre>
        </div>
    </div>
    @endif

    @if($chapter->explanation)
    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <h3 class="font-bold mb-2">💡 Explanation</h3>
        <p class="text-gray-700">{{ $chapter->explanation }}</p>
    </div>
    @endif
</div>

<!-- Chapter Stats -->
<div class="grid grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Users Completed</div>
        <div class="text-3xl font-bold">{{ $chapter->userProgress()->where('completed', true)->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Total Views</div>
        <div class="text-3xl font-bold">{{ $chapter->userProgress()->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-600 mb-1">Completion Rate</div>
        <div class="text-3xl font-bold">
            {{ $chapter->userProgress()->count() > 0 ? round(($chapter->userProgress()->where('completed', true)->count() / $chapter->userProgress()->count()) * 100) : 0 }}%
        </div>
    </div>
</div>
@endsection