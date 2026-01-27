<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Learning Platform - Belajar Web Development dari Nol</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #2563EB 0%, #7C3AED 50%, #DB2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .blob {
            position: absolute;
            filter: blur(40px);
            z-index: -1;
            opacity: 0.6;
            animation: float 10s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50 selection:bg-blue-100 selection:text-blue-900">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 py-6 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-gray-900 to-gray-700">CodeLearn</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="#kursus" class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Kursus</a>
                    <a href="#features"
                        class="text-gray-600 hover:text-blue-600 font-medium transition-colors">Fitur</a>
                </div>

                <!-- Desktop Auth Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="px-5 py-2.5 bg-gray-900 text-white rounded-full hover:bg-gray-800 transition shadow-lg hover:shadow-xl font-medium text-sm">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}"
                                class="px-5 py-2.5 bg-gray-900 text-white rounded-full hover:bg-gray-800 transition shadow-lg hover:shadow-xl font-medium text-sm">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-0.5 font-medium text-sm">Register</a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <button id="mobile-menu-btn" class="md:hidden flex items-center p-2 text-gray-600 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="hamburger-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


        </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home"
        class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-[80vh] flex items-center">
        <!-- Background Decorations -->
        <div
            class="blob bg-gradient-to-tr from-blue-300 to-cyan-300 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2 opacity-60 mix-blend-multiply">
        </div>
        <div
            class="blob bg-gradient-to-bl from-purple-300 to-pink-300 w-96 h-96 rounded-full bottom-0 right-0 translate-x-1/2 translate-y-1/2 animation-delay-2000 opacity-60 mix-blend-multiply">
        </div>
        <div
            class="blob bg-gradient-to-r from-yellow-200 to-orange-300 w-80 h-80 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 animation-delay-4000 opacity-40 mix-blend-multiply blur-3xl">
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">

            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-md border border-white/40 shadow-sm text-blue-700 text-sm font-semibold mb-8 animate-fade-in-up hover:bg-white/80 transition-colors cursor-default">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                Platform Belajar Koding #1 di Indonesia
            </div>

            <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-[1.15]">
                Bangun Karir Impianmu <span
                    class="block text-2xl lg:text-3xl font-medium text-gray-500 mt-2">sebagai</span>
                <span class="gradient-text">Profesional Web Developer</span>
            </h1>

            <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                Pelajari skill paling dibutuhkan di industri tech saat ini. Kurikulum terstruktur, mentor berpengalaman,
                dan komunitas yang suportif.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full font-bold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg hover:shadow-indigo-500/40 transform hover:-translate-y-1 text-lg">
                    Mulai Belajar Sekarang
                </a>
                <a href="#kursus"
                    class="px-8 py-4 bg-white/80 backdrop-blur-sm text-gray-700 border border-white/60 rounded-full font-bold hover:bg-white hover:border-white transition shadow-sm hover:shadow-md text-lg">
                    Lihat Silabus
                </a>
            </div>

            <div class="mt-12 flex flex-wrap justify-center gap-4 sm:gap-8 text-sm font-medium text-gray-600">
                <div
                    class="flex items-center gap-2 px-4 py-2 bg-white/40 rounded-full backdrop-blur-sm border border-white/20">
                    <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Gratis Selamanya
                </div>
                <div
                    class="flex items-center gap-2 px-4 py-2 bg-white/40 rounded-full backdrop-blur-sm border border-white/20">
                    <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Sertifikat Kompetensi
                </div>
                <div
                    class="flex items-center gap-2 px-4 py-2 bg-white/40 rounded-full backdrop-blur-sm border border-white/20">
                    <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    Updated 2026
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white border-y border-gray-100 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group hover:-translate-y-1 transition duration-300">
                    <div
                        class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-cyan-500 mb-2">
                        {{ $modules->count() }}</div>
                    <div class="text-gray-500 font-medium">Modul Belajar</div>
                </div>
                <div class="text-center group hover:-translate-y-1 transition duration-300">
                    <div
                        class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-500 mb-2">
                        {{ $modules->sum('chapters_count') }}+</div>
                    <div class="text-gray-500 font-medium">Video Materi</div>
                </div>
                <div class="text-center group hover:-translate-y-1 transition duration-300">
                    <div
                        class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-red-500 mb-2">
                        10k+</div>
                    <div class="text-gray-500 font-medium">Siswa Aktif</div>
                </div>
                <div class="text-center group hover:-translate-y-1 transition duration-300">
                    <div
                        class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-500 to-emerald-500 mb-2">
                        4.9</div>
                    <div class="text-gray-500 font-medium">Rating Rata-rata</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kursus Section -->
    <section id="kursus" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Mulai Perjalanan Belajarmu</h2>
                <p class="text-xl text-gray-600">Pilih alur belajar yang sesuai dengan minat dan tujuan karirmu.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($modules as $module)
                    <div
                        class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full hover:-translate-y-2 hover:bg-blue-600 hover:border-blue-600">
                        <div class="p-8 flex-1">
                            <div
                                class="w-14 h-14 rounded-xl bg-blue-50 text-3xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-white transition-all duration-300 shadow-sm group-hover:shadow-none">
                                @if (Str::startsWith($module->icon, 'devicon-'))
                                    <i class="{{ $module->icon }} colored"></i>
                                @else
                                    {{ $module->icon }}
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-white transition-colors">
                                {{ $module->title }}
                            </h3>
                            <p class="text-gray-600 mb-6 text-sm leading-relaxed group-hover:text-blue-100">
                                {{ Str::limit($module->description, 100) }}
                            </p>
                        </div>
                        <div class="px-8 pb-8 mt-auto">
                            <div
                                class="flex items-center justify-between text-sm text-gray-500 mb-6 pt-6 border-t border-gray-50 group-hover:border-blue-500/30">
                                <span class="flex items-center gap-2 group-hover:text-blue-50">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-200" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $module->chapters_count }} Chapter
                                </span>
                                <span
                                    class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">Gratis</span>
                            </div>
                            @guest
                                <a href="{{ route('register') }}"
                                    class="block w-full text-center py-3 bg-gray-50 text-gray-900 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition-colors duration-300 border border-gray-200 hover:border-blue-600 group-hover:bg-white group-hover:text-blue-600 group-hover:border-white">
                                    Mulai Belajar
                                </a>
                            @else
                                <a href="{{ route('user.modules.show', $module->slug) }}"
                                    class="block w-full text-center py-3 bg-gray-50 text-gray-900 rounded-xl font-semibold hover:bg-blue-600 hover:text-white transition-colors duration-300 border border-gray-200 hover:border-blue-600 group-hover:bg-white group-hover:text-blue-600 group-hover:border-white">
                                    Lanjutkan
                                </a>
                            @endguest
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Kenapa Belajar di Platform Kami?</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Kami mendesain pengalaman belajar yang efektif, menyenangkan, dan relevan dengan kebutuhan
                        industri.
                    </p>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Kurikulum Terstruktur</h3>
                                <p class="text-gray-600">Materi disusun step-by-step untuk memastikan pemahaman yang
                                    mendalam.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Studi Kasus Nyata</h3>
                                <p class="text-gray-600">Belajar dengan membangun proyek-proyek real world yang bisa
                                    masuk portofolio.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Fleksibel</h3>
                                <p class="text-gray-600">Akses materi selamanya, belajar kapanpun dan dimanapun sesuai
                                    kecepatanmu.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Interactive Element Placeholder -->
                <div
                    class="relative bg-gray-50 rounded-3xl p-8 border border-gray-100 min-h-[400px] flex items-center justify-center">
                    <div class="text-center">
                        <div
                            class="inline-block p-4 bg-white rounded-full shadow-lg mb-6 text-yellow-400 animate-bounce delay-75">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">4.9 / 5.0</h3>
                        <p class="text-gray-500">Rating kepuasan siswa dari 500+ ulasan</p>
                    </div>

                    <!-- Decorative Elements -->
                    <div
                        class="absolute top-10 left-10 w-24 h-24 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="absolute bottom-10 right-10 w-24 h-24 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/4 w-20 h-20 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-20 pb-10 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="bg-blue-600 text-white p-1.5 rounded">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold">CodeLearn</span>
                    </div>
                    <p class="text-gray-400 max-w-sm mb-6">
                        Platform edukasi teknologi yang berfokus pada pengembangan talenta digital Indonesia untuk
                        bersaing di kancah global.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><span
                                class="sr-only">Twitter</span><svg class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><span
                                class="sr-only">GitHub</span><svg class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg></a>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Produk</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition">Online Course</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Bootcamp</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Corporate Training</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Dukungan</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} CodeLearn Academy. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Container (Added) -->
    <!-- Mobile Menu Container -->
    <div id="mobile-menu" class="md:hidden hidden fixed inset-0 bg-white z-40 p-6 pt-24 overflow-y-auto">
        <div class="flex flex-col space-y-4">
            <a href="#home"
                class="text-gray-800 hover:text-blue-600 text-lg font-semibold border-b border-gray-100 pb-2">Home</a>
            <a href="#kursus"
                class="text-gray-800 hover:text-blue-600 text-lg font-semibold border-b border-gray-100 pb-2">Kursus</a>
            <a href="#features"
                class="text-gray-800 hover:text-blue-600 text-lg font-semibold border-b border-gray-100 pb-2">Fitur</a>

            <div class="pt-4 flex flex-col gap-3">
                @auth
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="w-full text-center py-3 px-6 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('user.dashboard') }}"
                            class="w-full text-center py-3 px-6 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition-colors">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="w-full text-center py-3 px-6 bg-gray-100 text-gray-900 rounded-xl font-semibold hover:bg-gray-200 transition-colors">Login</a>
                    <a href="{{ route('register') }}"
                        class="w-full text-center py-3 px-6 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Navbar Scroll Script -->
    <script>
        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('glass-nav', 'shadow-sm');
                navbar.classList.remove('bg-transparent', 'py-6');
                navbar.classList.add('py-4');
            } else {
                navbar.classList.remove('glass-nav', 'shadow-sm', 'py-4');
                navbar.classList.add('bg-transparent', 'py-6');
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            // Add background to navbar when menu is open for better visibility
            if (!mobileMenu.classList.contains('hidden')) {
                navbar.classList.add('bg-white');
                navbar.classList.remove('bg-transparent');
            } else if (window.scrollY <= 20) {
                navbar.classList.remove('bg-white');
                navbar.classList.add('bg-transparent');
            }
        });

        // Close mobile menu when clicking a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });
    </script>
</body>

</html>
```
