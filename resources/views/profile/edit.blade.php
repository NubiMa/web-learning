@extends('layouts.user')

@section('title', 'Profile Settings')
@section('page-title', 'Profile')

@section('content')
    <!-- Header -->
    <div
        class="relative bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-lg p-8 mb-10 overflow-hidden text-white">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-bold mb-2">Profile Settings</h1>
            <p class="text-blue-100 text-lg">Manage your account information and preferences.</p>
        </div>
    </div>

    <div class="space-y-8">
        <!-- Profile Information -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
