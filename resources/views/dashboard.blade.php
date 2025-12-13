@extends('layouts.user')

@section('page-title', 'Kursus Anda')

@section('content')
<!-- Search Bar -->
<div class="mb-8">
    <div class="relative">
        <input type="text" placeholder="Cari kursus..." class="w-full pl-12 pr-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
        <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</div>

<!-- Course Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach($modules as $module)
    <a href="{{ route('user.modules.show', $module->slug) }}" class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100">
        <!-- Gradient Header -->
        <div class="h-40 bg-gradient-to-br {{ $module->color == 'blue' ? 'from-blue-400 to-cyan-400' : ($module->color == 'green' ? 'from-emerald-400 to-teal-400' : ($module->color == 'purple' ? 'from-purple-400 to-pink-400' : 'from-orange-400 to-yellow-400')) }} relative overflow-hidden">
            <div class="absolute inset-0 bg-black bg-opacity-10"></div>
            <div class="absolute bottom-4 left-6">
                <span class="text-5xl">{{ $module->icon }}</span>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                {{ $module->title }}
            </h3>
            <p class="text-gray-600 text-sm mb-4">
                Modul {{ $module->chapters->where('is_completed', true)->count() }} dari {{ $module->chapters->count() }} selesai
            </p>

            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-gray-600">Progress</span>
                    <span class="font-bold text-blue-600">{{ $module->progress_percentage }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $module->progress_percentage }}%"></div>
                </div>
            </div>

            <!-- Button -->
            <button class="w-full py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                {{ $module->progress_percentage > 0 ? 'Lanjutkan Belajar' : 'Mulai Belajar' }}
            </button>

            <!-- Certificate Badge -->
            @if($module->progress_percentage >= 100)
            <div class="mt-4 flex items-center justify-center">
                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium">
                    🎓 Lihat Sertifikat
                </span>
            </div>
            @endif
        </div>
    </a>
    @endforeach
</div>
@endsection