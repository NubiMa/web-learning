<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin Panel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen bg-gray-100">

        <!-- Mobile Header -->
        <div
            class="md:hidden fixed top-0 w-full z-40 bg-gray-900 text-white border-b border-gray-800 px-4 py-3 flex items-center justify-between shadow-md">
            <span class="text-lg font-bold">Admin Panel</span>
            <button id="sidebar-toggle"
                class="p-2 text-gray-300 hover:text-white focus:outline-none rounded-lg hover:bg-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Sidebar Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-gray-900/50 z-40 hidden md:hidden glass-effect transition-opacity duration-300">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto shadow-xl md:shadow-none">
            <div class="flex items-center justify-between h-16 bg-gray-900 px-6">
                <span class="text-xl font-bold">Admin Panel</span>
                <button id="sidebar-close" class="md:hidden text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <nav class="mt-6 px-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.modules.index') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.modules.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Modules
                </a>

                <a href="{{ route('admin.chapters.index') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.chapters.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Chapters
                </a>

                <a href="{{ route('admin.quizzes.index') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.quizzes.*') || request()->routeIs('admin.questions.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                    Quizzes
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : 'hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Users
                </a>
            </nav>

            <!-- User Menu -->
            <div class="absolute bottom-0 w-64 p-4 bg-gray-900">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Admin</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="md:ml-64 flex-1 flex flex-col min-h-screen pt-[60px] md:pt-0">
            <!-- Header -->
            @hasSection('page-title')
                <header class="bg-white shadow-sm">
                    <div class="px-6 py-4">
                        <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                    </div>
                </header>
            @endif

            <!-- Content -->
            <main class="p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarClose = document.getElementById('sidebar-close');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                const isHidden = sidebar.classList.contains('-translate-x-full');

                if (isHidden) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            }

            if (sidebarToggle) sidebarToggle.addEventListener('click', toggleSidebar);
            if (sidebarClose) sidebarClose.addEventListener('click', toggleSidebar);
            if (sidebarOverlay) sidebarOverlay.addEventListener('click', toggleSidebar);

            // Close when clicking link on mobile
            sidebar.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) toggleSidebar();
                });
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
