@extends('layouts.user')

@section('title', $chapter->title)

@section('content')
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex flex-wrap items-center gap-2 text-sm">
            <li><a href="{{ route('user.modules.index') }}" class="text-blue-600 hover:underline">Modules</a></li>
            <li>/</li>
            <li><a href="{{ route('user.modules.show', $chapter->module->slug) }}"
                    class="text-blue-600 hover:underline">{{ $chapter->module->title }}</a></li>
            <li>/</li>
            <li class="text-gray-600">{{ $chapter->title }}</li>
        </ol>
    </nav>

    <!-- Chapter Content -->
    <div class="bg-white rounded-lg shadow p-8 mb-6">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $chapter->title }}</h1>
            <form
                action="{{ $progress->completed ? route('user.chapters.uncomplete', $chapter->id) : route('user.chapters.complete', $chapter->id) }}"
                method="POST" class="w-full md:w-auto">
                @csrf
                <button type="submit"
                    class="flex items-center justify-center w-full md:w-auto px-6 py-2.5 rounded-lg {{ $progress->completed ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} hover:bg-opacity-80 transition font-medium">
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

        @if ($chapter->code_example)
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-3">Code Example</h2>
                <div class="rounded-xl overflow-hidden shadow-2xl bg-[#282c34] font-mono text-sm relative group">
                    <!-- Mac Toolbar -->
                    <div class="bg-[#21252b] px-4 py-2 flex items-center justify-between select-none">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                            <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                        </div>
                        <!-- Language Label (Optional) -->
                        <div class="text-gray-400 text-xs font-sans uppercase tracking-wider">
                            HTML
                        </div>
                        <!-- Copy Button -->
                        <button onclick="copyCode(this)"
                            class="text-gray-400 hover:text-white transition focus:outline-none" title="Copy code">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <!-- Code Content -->
                    <div class="overflow-x-auto p-4 md:p-6">
                        <pre><code class="language-html bg-transparent p-0">{{ $chapter->code_example }}</code></pre>
                    </div>
                </div>
            </div>

            <!-- Copy Script -->
            <script>
                function copyCode(button) {
                    const code = button.closest('.group').querySelector('code').innerText;
                    navigator.clipboard.writeText(code).then(() => {
                        // Change icon to checkmark
                        const originalIcon = button.innerHTML;
                        button.innerHTML = `
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                `;
                        setTimeout(() => {
                            button.innerHTML = originalIcon;
                        }, 2000);
                    });
                }
            </script>
        @endif

        @if ($chapter->explanation)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded">
                <h3 class="font-bold mb-2">💡 Explanation</h3>
                <p class="text-gray-700">{{ $chapter->explanation }}</p>
            </div>
        @endif
    </div>

    <!-- Navigation -->
    <div class="flex flex-col md:flex-row justify-between gap-4">
        @if ($previous_chapter)
            <a href="{{ route('user.chapters.show', $previous_chapter->id) }}"
                class="flex items-center justify-center px-6 py-3 bg-white rounded-lg shadow hover:shadow-md transition text-gray-700 font-medium order-2 md:order-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Previous
            </a>
        @else
            <div class="hidden md:block order-2 md:order-1"></div>
        @endif

        @if ($next_chapter)
            <a href="{{ route('user.chapters.show', $next_chapter->id) }}"
                class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition font-medium order-1 md:order-2">
                Next
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        @else
            <a href="{{ route('user.modules.show', $chapter->module->slug) }}"
                class="flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition font-medium order-1 md:order-2">
                Back to Module
            </a>
        @endif
    </div>
@endsection
