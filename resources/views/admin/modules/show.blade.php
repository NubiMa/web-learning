@extends('layouts.admin')

@section('title', $module->title)
@section('page-title', 'Module: ' . $module->title)

@section('content')
<div class="mb-6 flex justify-between items-center">
    <a href="{{ route('admin.modules.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Modules
    </a>
    <div class="flex space-x-3">
        <a href="{{ route('admin.modules.edit', $module) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Edit Module
        </a>
        <a href="{{ route('admin.chapters.create') }}?module_id={{ $module->id }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            Add Chapter
        </a>
    </div>
</div>

<!-- Module Info Card -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="flex items-start">
        <span class="text-5xl mr-4">{{ $module->icon }}</span>
        <div class="flex-1">
            <h2 class="text-2xl font-bold mb-2">{{ $module->title }}</h2>
            <p class="text-gray-600 mb-4">{{ $module->description }}</p>
            <div class="flex items-center space-x-6">
                <span class="text-sm text-gray-600">📚 {{ $module->chapters->count() }} Chapters</span>
                <span class="text-sm text-gray-600">📝 {{ $module->quizzes->count() }} Quizzes</span>
                <span class="px-3 py-1 rounded-full text-sm {{ $module->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $module->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Chapters List -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-6 border-b flex justify-between items-center">
        <h3 class="text-lg font-bold">Chapters</h3>
        <a href="{{ route('admin.chapters.create') }}?module_id={{ $module->id }}" class="text-blue-600 hover:text-blue-800">
            + Add Chapter
        </a>
    </div>
    <div class="divide-y">
        @forelse($module->chapters as $chapter)
        <div class="p-6 flex items-center justify-between hover:bg-gray-50">
            <div class="flex items-center flex-1">
                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-4">
                    {{ $chapter->order }}
                </span>
                <div>
                    <h4 class="font-medium">{{ $chapter->title }}</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($chapter->content), 100) }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 rounded-full text-xs {{ $chapter->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $chapter->is_active ? 'Active' : 'Inactive' }}
                </span>
                <a href="{{ route('admin.chapters.edit', $chapter) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            No chapters yet. Add your first chapter.
        </div>
        @endforelse
    </div>
</div>

<!-- Quizzes List -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6 border-b flex justify-between items-center">
        <h3 class="text-lg font-bold">Quizzes</h3>
        <a href="{{ route('admin.quizzes.create') }}" class="text-blue-600 hover:text-blue-800">
            + Add Quiz
        </a>
    </div>
    <div class="divide-y">
        @forelse($module->quizzes as $quiz)
        <div class="p-6 flex items-center justify-between hover:bg-gray-50">
            <div>
                <h4 class="font-medium">{{ $quiz->title }}</h4>
                <p class="text-sm text-gray-600">{{ $quiz->questions->count() }} questions • Pass: {{ $quiz->passing_score }}%</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 rounded-full text-xs {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $quiz->is_active ? 'Active' : 'Inactive' }}
                </span>
                <a href="{{ route('admin.quizzes.show', $quiz) }}" class="text-blue-600 hover:text-blue-900">Manage</a>
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-gray-500">
            No quizzes yet. Add your first quiz.
        </div>
        @endforelse
    </div>
</div>
@endsection