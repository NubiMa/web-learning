{{-- resources/views/user/profile/edit.blade.php (FIXED) --}}
@extends('layouts.user')

@section('title', 'Account Settings')
@section('page-title', 'Account Settings')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Account Settings</h1>
        <p class="text-gray-600">Manage your profile details, security preferences, and view your activity.</p>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Sidebar Navigation -->
        <div class="col-span-12 lg:col-span-3">
            <div class="bg-white rounded-xl shadow-sm p-4">
                <!-- User Info -->
                <div class="text-center mb-6 pb-6 border-b border-gray-200">
                    @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-20 h-20 mx-auto mb-3 rounded-full object-cover">
                    @else
                        <div class="w-20 h-20 mx-auto mb-3 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <h3 class="font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ Auth::user()->role == 'admin' ? 'ADMIN' : 'STUDENT' }}</p>
                </div>

                <!-- Navigation Items -->
                <nav class="space-y-1">
                    <a href="#general" class="flex items-center px-4 py-3 text-blue-600 bg-blue-50 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium">General Profile</span>
                    </a>

                    <a href="#security" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span class="font-medium">Security</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium">Log Out</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-span-12 lg:col-span-9 space-y-6">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <!-- Profile Photo Section (FIXED) -->
            <div id="general" class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center">
                        <div class="relative">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile" class="w-24 h-24 rounded-full object-cover">
                            @else
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            
                            <!-- Upload Button -->
                            <form id="uploadPictureForm" method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" style="display:none;">
                                @csrf
                                @method('PATCH')
                                <input type="file" id="profilePictureInput" name="profile_picture" accept="image/*">
                            </form>
                            
                            <button onclick="document.getElementById('profilePictureInput').click()" class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-gray-900">Profile Photo</h3>
                            <p class="text-sm text-gray-600">JPG, PNG or GIF. Max size 2MB.</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        @if(Auth::user()->profile_picture)
                        <form method="POST" action="{{ route('user.profile.deletePicture') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Personal Information (FIXED) -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Personal Information</h3>
                <p class="text-sm text-gray-600 mb-6">Update your personal details here.</p>

                <form method="POST" action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-2 gap-6">
                        <!-- First Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ explode(' ', Auth::user()->name)[0] }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ count(explode(' ', Auth::user()->name)) > 1 ? explode(' ', Auth::user()->name)[1] : '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <!-- Email (Read-only) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="email" value="{{ Auth::user()->email }}" disabled class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                            </div>
                        </div>

                        <!-- Job Title (FIXED) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Job Title / Role</label>
                            <input type="text" name="job_title" value="{{ Auth::user()->job_title }}" placeholder="Full Stack Student" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Bio (FIXED) -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" id="bioTextarea" rows="4" maxlength="240" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tell us about yourself...">{{ Auth::user()->bio }}</textarea>
                        <p class="mt-1 text-sm text-gray-500 text-right">
                            <span id="charCount">{{ 240 - strlen(Auth::user()->bio ?? '') }}</span> characters left
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="window.location.reload()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Security Section -->
            <div id="security" class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Change Password</h3>
                <p class="text-sm text-gray-600 mb-6">Update your password to keep your account secure.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Current Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('current_password', 'updatePassword')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('password', 'updatePassword')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="this.form.reset()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-submit profile picture form when file selected
document.getElementById('profilePictureInput').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        document.getElementById('uploadPictureForm').submit();
    }
});

// Character counter for bio
const bioTextarea = document.getElementById('bioTextarea');
const charCount = document.getElementById('charCount');

if (bioTextarea && charCount) {
    bioTextarea.addEventListener('input', function() {
        const remaining = 240 - this.value.length;
        charCount.textContent = remaining;
    });
}

// Smooth scroll to sections
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
@endpush
@endsection