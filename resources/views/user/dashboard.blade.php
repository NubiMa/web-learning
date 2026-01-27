@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div
        class="relative bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl shadow-xl p-8 mb-10 overflow-hidden text-white">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Welcome back, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-blue-100 text-lg">Continue your learning journey and achieve your goals.</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-green-50 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">All Time</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Total Completed</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_completed'] }}</p>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-blue-50 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">Active</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Quizzes Taken</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_quizzes_taken'] }}</p>
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
                <span
                    class="text-xs font-semibold px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700">Performance</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Average Score</p>
                <p class="text-3xl font-bold text-gray-900">{{ round($stats['average_score']) }}%</p>
            </div>
        </div>

        <div
            class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 rounded-xl bg-purple-50 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-100 text-purple-700">Success</span>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium mb-1">Quizzes Passed</p>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['quizzes_passed'] }}</p>
            </div>
        </div>
    </div>

    <!-- Learning Modules -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Your Learning Modules</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($modules as $module)
                <a href="{{ route('user.modules.show', $module->slug) }}"
                    class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center text-4xl mr-5 shadow-inner">
                                @if (Str::startsWith($module->icon, 'devicon-'))
                                    <i class="{{ $module->icon }} colored"></i>
                                @else
                                    {{ $module->icon }}
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $module->title }}</h3>
                                <p class="text-gray-500 text-sm mb-5 leading-relaxed">
                                    {{ Str::limit($module->description, 100) }}</p>

                                <div class="space-y-2">
                                    <div class="flex justify-between text-xs font-medium uppercase tracking-wide">
                                        <span class="text-gray-400">Progress</span>
                                        <span class="text-blue-600">{{ $module->progress_percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2.5 rounded-full transition-all duration-500 shadow-[0_0_10px_rgba(37,99,235,0.3)]"
                                            style="width: {{ $module->progress_percentage }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-xs font-medium text-gray-500">Last updated
                            {{ $module->updated_at->diffForHumans() }}</span>
                        <span
                            class="text-sm font-semibold text-blue-600 group-hover:translate-x-1 transition-transform flex items-center">
                            Continue Learning
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Recent Quiz Attempts -->
    @if ($recent_attempts->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-xl font-bold text-gray-900">Recent Quiz Attempts</h2>
                <span class="text-sm text-gray-500">Last 5 attempts</span>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach ($recent_attempts as $attempt)
                    <div class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full {{ $attempt->passed ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} flex items-center justify-center mr-4">
                                @if ($attempt->passed)
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $attempt->quiz->title }}</p>
                                <p class="text-sm text-gray-500 flex items-center gap-2">
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    {{ $attempt->quiz->module->title }}
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    {{ $attempt->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold {{ $attempt->passed ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-red-50 text-red-700 border border-red-100' }}">
                                {{ $attempt->score }}%
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
