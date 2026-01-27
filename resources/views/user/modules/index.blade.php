@extends('layouts.user')

@section('title', 'Learning Modules')

@section('content')
    <!-- Header -->
    <div
        class="relative bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-lg p-8 mb-10 overflow-hidden text-white">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Learning Modules</h1>
            <p class="text-blue-100 text-lg">Explore our comprehensive curriculum and master new skills.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach ($modules as $module)
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden hover:-translate-y-1">
                <div class="p-8">
                    <div class="flex items-start mb-6">
                        <div
                            class="flex-shrink-0 w-20 h-20 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center text-5xl mr-6 shadow-inner">
                            @if (Str::startsWith($module->icon, 'devicon-'))
                                <i class="{{ $module->icon }} colored"></i>
                            @else
                                {{ $module->icon }}
                            @endif
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $module->title }}</h2>
                            <p class="text-gray-500 leading-relaxed">{{ Str::limit($module->description, 120) }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center p-3 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="block text-xs text-gray-500 font-medium uppercase tracking-wider">Content</span>
                                <span class="font-bold text-gray-900">{{ $module->total_chapters }} Chapters</span>
                            </div>
                        </div>
                        <div class="flex items-center p-3 rounded-lg bg-gray-50 border border-gray-100">
                            <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <span
                                    class="block text-xs text-gray-500 font-medium uppercase tracking-wider">Completed</span>
                                <span class="font-bold text-gray-900">{{ $module->completed_chapters }} Done</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-8">
                        <div class="flex justify-between text-sm font-medium">
                            <span class="text-gray-500">Overall Progress</span>
                            <span class="text-blue-600">{{ $module->progress_percentage }}%</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full transition-all duration-500 shadow-[0_0_10px_rgba(37,99,235,0.3)]"
                                style="width: {{ $module->progress_percentage }}%"></div>
                        </div>
                    </div>

                    <a href="{{ route('user.modules.show', $module->slug) }}"
                        class="block w-full text-center px-6 py-4 bg-gray-900 text-white rounded-xl font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 transform group-hover:-translate-y-0.5">
                        Continue Learning
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
