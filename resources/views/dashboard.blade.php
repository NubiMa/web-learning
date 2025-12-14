@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="bg-white rounded-lg shadow p-6 mb-8">
    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
    <p class="text-gray-600">Continue your learning journey</p>
</div>

<!-- Search Bar -->
<div class="mb-8">
    <div class="relative">
        <input 
            type="text" 
            id="moduleSearch"
            placeholder="Cari modul pembelajaran..." 
            class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
        >
        <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- ... existing stats cards ... -->
</div>

<!-- Learning Modules -->
<div class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Your Learning Modules</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="modulesGrid">
        @foreach($modules as $module)
        <a 
            href="{{ route('user.modules.show', $module->slug) }}" 
            class="bg-white rounded-lg shadow hover:shadow-lg transition p-6"
            data-module-card
            data-module-title="{{ $module->title }}"
            data-module-description="{{ $module->description }}"
        >
            <div class="flex items-start">
                <span class="text-4xl mr-4">{{ $module->icon }}</span>
                <div class="flex-1">
                    <h3 class="text-xl font-bold mb-2">{{ $module->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($module->description, 100) }}</p>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Progress</span>
                            <span class="font-medium">{{ $module->progress_percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $module->progress_percentage }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <!-- No Results Message -->
    <div id="noSearchResults" style="display: none;" class="text-center py-12">
        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-gray-600 text-lg">No modules found matching your search.</p>
        <button onclick="document.getElementById('moduleSearch').value=''; document.getElementById('moduleSearch').dispatchEvent(new Event('input'));" class="mt-4 text-blue-600 hover:text-blue-800">
            Clear search
        </button>
    </div>
</div>

<!-- Recent Quiz Attempts -->
@if($recent_attempts->count() > 0)
<div class="bg-white rounded-lg shadow">
    <!-- ... existing quiz attempts ... -->
</div>
@endif
@endsection