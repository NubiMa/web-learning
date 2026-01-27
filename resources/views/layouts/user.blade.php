<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - CodeLearn</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Devicon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">

    <!-- Highlight.js Theme (Atom One Dark) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
</head>

<body class="font-sans antialiased bg-gray-50">
    <div
        class="flex h-screen overflow-hidden bg-gray-50 from-gray-50 to-white selection:bg-blue-100 selection:text-blue-900">

        <!-- Mobile Header (Visible on Mobile Only) -->
        <div
            class="md:hidden fixed top-0 w-full z-40 bg-white border-b border-gray-100 px-4 py-3 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 text-white p-1.5 rounded-lg shadow-sm shadow-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <span
                    class="text-lg font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-700">CodeLearn</span>
            </div>
            <button id="sidebar-toggle"
                class="p-2 text-gray-500 hover:text-blue-600 focus:outline-none bg-gray-50 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Sidebar Overlay (Mobile Only) -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-gray-900/50 z-40 hidden md:hidden glass-effect transition-opacity duration-300">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out md:relative md:flex-shrink-0 flex flex-col h-full shadow-xl md:shadow-none">
            <!-- Logo (Hidden on Mobile, Visible on Desktop) -->
            <div class="p-6 border-b border-gray-100 hidden md:block">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-600 text-white p-2 rounded-lg shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-700">CodeLearn</span>
                </div>
            </div>

            <!-- Mobile Close Button Header -->
            <div class="p-4 border-b border-gray-100 flex items-center justify-between md:hidden bg-gray-50/50">
                <span class="font-bold text-gray-900">Menu</span>
                <button id="sidebar-close" class="p-2 text-gray-500 hover:text-red-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="p-4 flex-1 overflow-y-auto space-y-1">
                <!-- Dashboard -->
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm shadow-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('user.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <!-- Modules -->
                <a href="{{ route('user.modules.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.modules.*') || request()->routeIs('user.chapters.*') || request()->routeIs('user.quizzes.*') ? 'bg-blue-50 text-blue-600 shadow-sm shadow-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('user.modules.*') || request()->routeIs('user.chapters.*') || request()->routeIs('user.quizzes.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <span class="font-medium">Materi</span>
                </a>

                <!-- Progress -->
                <a href="{{ route('user.progress.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.progress.*') ? 'bg-blue-50 text-blue-600 shadow-sm shadow-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('user.progress.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span class="font-medium">Progress</span>
                </a>

                <!-- Profile -->
                <a href="{{ route('user.profile.edit') }}"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.profile.*') ? 'bg-blue-50 text-blue-600 shadow-sm shadow-blue-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('user.profile.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-500' }} transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Profil</span>
                </a>
            </nav>

            <!-- User Info (Bottom) -->
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                <div
                    class="flex items-center gap-3 p-2 rounded-xl hover:bg-white hover:shadow-sm transition-all duration-200 cursor-default">
                    @if (Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile"
                            class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                    @else
                        <div
                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold ring-2 ring-white shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                            title="Logout">
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
        <div class="flex-1 flex flex-col overflow-hidden pt-[60px] md:pt-0">
            <!-- Top Bar -->
            <!-- <header class="bg-white border-b border-gray-200 px-8 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Selamat datang kembali, ' . Auth::user()->name . '!')</h1>
                    </div>
                    <div class="flex items-center space-x-4"> -->
            <!-- Search -->
            <!-- <div class="relative">
                            <input type="text" placeholder="Cari kursus..." class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </header> -->

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-8">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                        {{ session('error') }}
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
                    // Open sidebar
                    sidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                } else {
                    // Close sidebar
                    sidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                }
            }

            // Toggle button click
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            // Close button click
            if (sidebarClose) {
                sidebarClose.addEventListener('click', toggleSidebar);
            }

            // Overlay click
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', toggleSidebar);
            }

            // Close sidebar when clicking a link on mobile
            const sidebarLinks = sidebar.querySelectorAll('a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 768) {
                        toggleSidebar();
                    }
                });
            });

            // Handle window resize
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
    <!-- Scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Highlight.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();
    </script>
</body>

</html>
