{{-- resources/views/user/progress/index.blade.php --}}
@extends('layouts.user')

@section('title', 'My Progress')
@section('page-title', 'Learning Progress')

@section('content')
<!-- Search Bar -->
<div class="mb-8">
    <div class="relative">
        <input 
            type="text" 
            id="moduleSearch"
            placeholder="Cari kursus..." 
            class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
        >
        <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Overall Progress</span>
            <div class="p-2 bg-blue-100 rounded-lg">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $stats['completion_percentage'] }}%</p>
        <p class="text-xs text-gray-500 mt-1">{{ $stats['completed_chapters'] }}/{{ $stats['total_chapters'] }} chapters</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Quizzes Taken</span>
            <div class="p-2 bg-green-100 rounded-lg">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $stats['total_quizzes_taken'] }}</p>
        <p class="text-xs text-gray-500 mt-1">{{ $stats['quizzes_passed'] }} passed</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Average Score</span>
            <div class="p-2 bg-yellow-100 rounded-lg">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ round($stats['average_score']) }}%</p>
        <p class="text-xs text-gray-500 mt-1">Quiz performance</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-gray-600">Chapters Done</span>
            <div class="p-2 bg-purple-100 rounded-lg">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold">{{ $stats['completed_chapters'] }}</p>
        <p class="text-xs text-gray-500 mt-1">Total completed</p>
    </div>
</div>

<!-- Module Progress -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">Module Progress</h2>
        <!-- <a href="#" onclick="exportProgress()" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export Progress
        </a> -->
    </div>

    <div class="space-y-6">
        @foreach($modules as $module)
        <div class="border rounded-lg p-4">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center">
                    <span class="text-3xl mr-3">{{ $module->icon }}</span>
                    <div>
                        <h3 class="font-bold text-lg">{{ $module->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $module->completed_chapters_count }}/{{ $module->chapters->count() }} chapters completed</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-blue-600">{{ $module->progress_percentage }}%</p>
                    @if($module->progress_percentage >= 100)
                    <span class="inline-block mt-1 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                        ✓ Completed
                    </span>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full transition-all" style="width: {{ $module->progress_percentage }}%"></div>
                </div>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('user.modules.show', $module->slug) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Continue Learning →
                </a>
                @if($module->completed_chapters > 0)
                <form action="{{ route('user.progress.reset', $module) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to reset progress for this module?')">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                        Reset Progress
                    </button>
                </form>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Recent Activity -->
@if($recent_completions->count() > 0)
<div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
    <div class="space-y-3">
        @foreach($recent_completions as $completion)
        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-medium">{{ $completion->chapter->title }}</p>
                    <p class="text-sm text-gray-600">{{ $completion->chapter->module->title }}</p>
                </div>
            </div>
            <span class="text-sm text-gray-500">{{ $completion->completed_at->diffForHumans() }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

@push('scripts')
<!-- <script>
function exportProgress() {
    window.location.href = '{{ route("user.progress.export") }}';
}
</script> -->
@endpush
@endsection