@extends('layouts.user')

@section('title', 'Learning Modules')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold mb-2">Learning Modules</h1>
    <p class="text-gray-600">Choose a module to start learning</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    @foreach($modules as $module)
    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
        <div class="p-8">
            <div class="flex items-start mb-4">
                <span class="text-5xl mr-4">{{ $module->icon }}</span>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold mb-2">{{ $module->title }}</h2>
                    <p class="text-gray-600">{{ $module->description }}</p>
                </div>
            </div>

            <div class="space-y-3 mb-6">
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    {{ $module->total_chapters }} Chapters
                </div>
                <div class="flex items-center text-sm text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ $module->completed_chapters }} Completed
                </div>
            </div>

            <div class="space-y-2 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Progress</span>
                    <span class="font-bold text-blue-600">{{ $module->progress_percentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                    <div class="bg-blue-600 h-3 rounded-full transition-all" style="width: {{ $module->progress_percentage }}%"></div>
                </div>
            </div>

            <a href="{{ route('user.modules.show', $module->slug) }}" class="block w-full text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Continue Learning
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection