{{-- resources/views/user/progress/module.blade.php --}}
@extends('layouts.user')

@section('title', $module->title . ' Progress')
@section('page-title', $module->title . ' - Detailed Progress')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('user.progress.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Progress Overview
    </a>
</div>

<!-- Module Header -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-8">
    <div class="flex items-start justify-between">
        <div class="flex items-center">
            <span class="text-5xl mr-4">{{ $module->icon }}</span>
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $module->title }}</h1>
                <p class="text-gray-600">{{ $module->description }}</p>
            </div>
        </div>
        <div class="text-right">
            <p class="text-4xl font-bold text-blue-600">{{ $progress_percentage }}%</p>
            <p class="text-sm text-gray-600 mt-1">Complete</p>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="mt-6">
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-4 rounded-full transition-all duration-500" style="width: {{ $progress_percentage }}%"></div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-3 mt-6">
        <a href="{{ route('user.modules.show', $module->slug) }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
            Continue Learning
        </a>
        @if($chapters->where('completed', true)->count() > 0)
        <form action="{{ route('user.progress.reset', $module) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to reset all progress for this module? This action cannot be undone.')">
            @csrf
            <button type="submit" class="px-6 py-3 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition font-medium">
                Reset Progress
            </button>
        </form>
        @endif
    </div>
</div>

<!-- Chapter List -->
<div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold mb-6">Chapter Progress</h2>
    
    <div class="space-y-3">
        @foreach($chapters as $chapter)
        <div class="flex items-center justify-between p-4 border rounded-lg {{ $chapter->completed ? 'bg-green-50 border-green-200' : 'bg-gray-50 border-gray-200' }}">
            <div class="flex items-center flex-1">
                <!-- Order Number -->
                <div class="w-10 h-10 rounded-full {{ $chapter->completed ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center text-white font-bold mr-4">
                    @if($chapter->completed)
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @else
                        {{ $chapter->order }}
                    @endif
                </div>

                <!-- Chapter Info -->
                <div class="flex-1">
                    <h3 class="font-bold {{ $chapter->completed ? 'text-green-800' : 'text-gray-900' }}">
                        {{ $chapter->title }}
                    </h3>
                    @if($chapter->completed && $chapter->completed_at)
                    <p class="text-sm {{ $chapter->completed ? 'text-green-600' : 'text-gray-600' }}">
                        Completed {{ $chapter->completed_at->diffForHumans() }}
                    </p>
                    @else
                    <p class="text-sm text-gray-600">Not started yet</p>
                    @endif
                </div>

                <!-- Status Badge -->
                <div class="ml-4">
                    @if($chapter->completed)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Completed
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                            Pending
                        </span>
                    @endif
                </div>
            </div>

            <!-- Action Button -->
            <div class="ml-4">
                <a href="{{ route('user.chapters.show', $chapter->id) }}" class="px-4 py-2 {{ $chapter->completed ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700' }} text-white rounded-lg transition text-sm font-medium">
                    {{ $chapter->completed ? 'Review' : 'Start' }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Stats Summary -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Total Chapters</p>
                <p class="text-3xl font-bold">{{ $chapters->count() }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-lg">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Completed</p>
                <p class="text-3xl font-bold text-green-600">{{ $chapters->where('completed', true)->count() }}</p>
            </div>
            <div class="p-3 bg-green-100 rounded-lg">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600">Remaining</p>
                <p class="text-3xl font-bold text-orange-600">{{ $chapters->where('completed', false)->count() }}</p>
            </div>
            <div class="p-3 bg-orange-100 rounded-lg">
                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>
@endsection