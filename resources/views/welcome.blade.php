{{-- resources/views/welcome.blade.php (ENHANCED) --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Learning Platform - Belajar Web Development dari Nol</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">CodeLearn</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                    <a href="#kursus" class="text-gray-700 hover:text-blue-600 font-medium">Kursus</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 font-medium">Tentang Kami</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Daftar Gratis
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="pt-24 pb-20 bg-gradient-to-br from-blue-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-block px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium mb-6">
                        🚀 Platform Belajar Modern
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Master Web Development with 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                            Laravel & Tailwind CSS
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Platform belajar modern yang akan membawamu dari nol hingga mahir membangun aplikasi web powerful dan responsif.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium shadow-lg hover:shadow-xl">
                            Mulai Belajar Sekarang
                        </a>
                        <a href="#kursus" class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-lg hover:border-blue-600 hover:text-blue-600 transition font-medium">
                            Lihat Kursus
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-12">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">{{ $modules->count() }}</div>
                            <div class="text-sm text-gray-600">Modul Tersedia</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">{{ $modules->sum('chapters_count') }}+</div>
                            <div class="text-sm text-gray-600">Chapter Lengkap</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">100%</div>
                            <div class="text-sm text-gray-600">Gratis</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Code Preview -->
                <div class="relative">
                    <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden">
                        <!-- Window Bar -->
                        <div class="flex items-center space-x-2 px-4 py-3 bg-gray-800">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="ml-4 text-sm text-gray-400">CodeLearn</span>
                        </div>
                        <!-- Code -->
                        <div class="p-6 text-sm font-mono">
                            <pre class="text-gray-300"><code><span class="text-pink-400">&lt;div</span> <span class="text-blue-400">class</span>=<span class="text-green-400">"container mx-auto"</span><span class="text-pink-400">&gt;</span>
    <span class="text-pink-400">&lt;h1</span> <span class="text-blue-400">class</span>=<span class="text-green-400">"text-4xl font-bold"</span><span class="text-pink-400">&gt;</span>
        Hello World
    <span class="text-pink-400">&lt;/h1&gt;</span>
    <span class="text-pink-400">&lt;p</span> <span class="text-blue-400">class</span>=<span class="text-green-400">"text-gray-600"</span><span class="text-pink-400">&gt;</span>
        Belajar Laravel & Tailwind
    <span class="text-pink-400">&lt;/p&gt;</span>
<span class="text-pink-400">&lt;/div&gt;</span></code></pre>
                        </div>
                    </div>
                    <!-- Decoration -->
                    <div class="absolute -bottom-6 -right-6 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute -top-6 -left-6 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modules Section -->
    <section id="kursus" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Kursus Populer Untukmu</h2>
                <p class="text-xl text-gray-600">Belajar dari dasar hingga mahir dengan kurikulum terstruktur</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($modules as $module)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                    <div class="p-8">
                        <div class="text-5xl mb-4">{{ $module->icon }}</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition">
                            {{ $module->title }}
                        </h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ Str::limit($module->description, 80) }}
                        </p>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            {{ $module->chapters_count }} Chapter
                        </div>
                        @guest
                        <a href="{{ route('register') }}" class="block text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Mulai Belajar
                        </a>
                        @else
                        <a href="{{ route('user.modules.show', $module->slug) }}" class="block text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                            Lanjutkan Belajar
                        </a>
                        @endguest
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Kenapa Belajar di Sini?</h2>
                <p class="text-xl text-gray-600">Platform modern dengan berbagai keunggulan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Materi Terstruktur</h3>
                    <p class="text-gray-600">Kurikulum step-by-step yang dirancang untuk pemula hingga advanced learner</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Quiz Interaktif</h3>
                    <p class="text-gray-600">Test pemahamanmu dengan quiz dan dapatkan feedback langsung</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Progress Tracking</h3>
                    <p class="text-gray-600">Monitor perkembangan belajarmu dengan sistem tracking yang detail</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Memulai Perjalanan Belajarmu?</h2>
            <p class="text-xl mb-8 text-blue-100">Bergabung dengan ribuan developer yang sudah belajar di platform kami</p>
            <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-bold text-lg shadow-xl">
                Daftar Gratis Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="tentang" class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                        </svg>
                        <span class="ml-2 text-xl font-bold">CodeLearn</span>
                    </div>
                    <p class="text-gray-400">Platform pembelajaran web development modern untuk Indonesia</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Kursus</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">HTML</a></li>
                        <li><a href="#" class="hover:text-white">CSS</a></li>
                        <li><a href="#" class="hover:text-white">JavaScript</a></li>
                        <li><a href="#" class="hover:text-white">PHP</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Perusahaan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Kontak</a></li>
                        <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@codelearn.id</li>
                        <li>WhatsApp: +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} CodeLearn. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
</body>
</html>