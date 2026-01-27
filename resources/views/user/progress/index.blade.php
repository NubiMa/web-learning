@extends('layouts.user')

@section('title', 'My Progress')
@section('page-title', 'Learning Progress')

@section('content')
    <!-- Header -->
    <div
        class="relative bg-gradient-to-r from-blue-600 to-cyan-500 rounded-3xl shadow-lg p-8 mb-10 overflow-hidden text-white">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-cyan-400/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">My Progress</h1>
            <p class="text-blue-100 text-lg">Track your achievements and keep moving forward.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">Total</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Overall Progress</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['completion_percentage'] }}%</p>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['completed_chapters'] }}/{{ $stats['total_chapters'] }}
                    chapters</p>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-green-50 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Exam</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Quizzes Taken</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_quizzes_taken'] }}</p>
                <p class="text-xs text-gray-400 mt-1">{{ $stats['quizzes_passed'] }} passed</p>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-yellow-50 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700">Avg</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Average Score</p>
                <p class="text-3xl font-bold text-gray-900">{{ round($stats['average_score']) }}%</p>
                <p class="text-xs text-gray-400 mt-1">Quiz performance</p>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-100 text-purple-700">Done</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Chapters Done</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_chapters'] }}</p>
                <p class="text-xs text-gray-400 mt-1">Total completed</p>
            </div>
        </div>
    </div>

    <!-- Module Progress -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-10">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Module Progress Details</h2>
                <p class="text-gray-500 mt-1">Breakdown of your progress by module.</p>
            </div>
        </div>

        <div class="space-y-6">
            @foreach ($modules as $module)
                <div
                    class="group border border-gray-100 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:border-blue-100 bg-gray-50/30 hover:bg-white">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-6">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-4xl mr-5 border border-gray-100">
                                @if (Str::startsWith($module->icon, 'devicon-'))
                                    <i class="{{ $module->icon }} colored"></i>
                                @else
                                    {{ $module->icon }}
                                @endif
                            </div>
                            <div>
                                <h3
                                    class="font-bold text-xl text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                                    {{ $module->title }}</h3>
                                <p class="text-sm text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $module->completed_chapters_count }}/{{ $module->chapters->count() }} chapters
                                    completed
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <span
                                    class="block text-2xl font-bold text-blue-600">{{ $module->progress_percentage }}%</span>
                                @if ($module->progress_percentage >= 100)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        In Progress
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full transition-all duration-500 shadow-[0_0_10px_rgba(59,130,246,0.3)]"
                                style="width: {{ $module->progress_percentage }}%"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <a href="{{ route('user.modules.show', $module->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                            Continue Learning
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        @if ($module->completed_chapters > 0)
                            <form action="{{ route('user.progress.reset', $module) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to reset progress for this module? This cannot be undone.')">
                                @csrf
                                <button type="submit"
                                    class="text-sm text-gray-400 hover:text-red-500 transition-colors flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Reset
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Activity -->
    @if ($recent_completions->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Activity</h2>
            </div>
            <div class="space-y-4">
                @foreach ($recent_completions as $completion)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-50/50 rounded-xl hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4 flex-shrink-0 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $completion->chapter->title }}</p>
                                <p class="text-sm text-gray-500">{{ $completion->chapter->module->title }}</p>
                            </div>
                        </div>
                        <span
                            class="text-sm font-medium text-gray-400 bg-white px-3 py-1 rounded-full border border-gray-100 shadow-sm">{{ $completion->completed_at->diffForHumans() }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @push('scripts')
        <!-- <script>
            function exportProgress() {
                window.location.href = '{{ route('user.progress.export') }}';
            }
        </script> -->
    @endpush
@endsection
