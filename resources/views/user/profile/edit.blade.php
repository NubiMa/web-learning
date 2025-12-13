@extends('layouts.user')

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
                    <div class="w-20 h-20 mx-auto mb-3 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h3 class="font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">PRO MEMBER</p>
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

                    <a href="#notifications" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="font-medium">Notifications</span>
                    </a>

                    <a href="#activity" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Activity Log</span>
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
            <!-- Profile Photo Section -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div class="flex items-center">
                        <div class="relative">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <button class="absolute bottom-0 right-0 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-gray-50">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-gray-900">Profile Photo</h3>
                            <p class="text-sm text-gray-600">This will be displayed on your profile and in course discussions.</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50">Delete</button>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Change Photo</button>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Personal Information</h3>
                <p class="text-sm text-gray-600 mb-6">Update your personal details here.</p>

                <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-6">
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

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Email -->
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

                        <!-- Job Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Job Title / Role</label>
                            <input type="text" name="job_title" placeholder="Full Stack Student" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea name="bio" rows="4" maxlength="240" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Passionate about learning Laravel and building modern web applications. Currently working on my portfolio."></textarea>
                        <p class="mt-1 text-sm text-gray-500 text-right">240 characters left</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                    </div>
                </form>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Recent Activity</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All</a>
                </div>

                <div class="space-y-4">
                    <!-- Activity Item -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-900">Completed course "Laravel 10 Fundamentals"</p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>

                    <!-- Activity Item -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-gray-900">Logged in from new device (MacBook Pro)</p>
                            <p class="text-xs text-gray-500">Yesterday at 10:45 AM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection