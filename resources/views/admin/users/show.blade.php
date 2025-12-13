@extends('layouts.admin')

@section('title', $user->name)
@section('page-title', 'User Details: ' . $user->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Users
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Info Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-center mb-6">
            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h3 class="text-xl font-bold">{{ $user->name }}</h3>
            <p class="text-gray-600">{{ $user->email }}</p>
            <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div class="space-y-3 border-t pt-4">
            <div class="flex justify-between">
                <span class="text-gray-600">Joined:</span>
                <span class="font-medium">{{ $user->created_at->format('M d, Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Chapters Completed:</span>
                <span class="font-medium">{{ $user->progress->where('completed', true)->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Quizzes Taken:</span>
                <span class="font-medium">{{ $user->quizAttempts->count() }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Avg Score:</span>
                <span class="font-medium">{{ round($user->quizAttempts->avg('score') ?? 0) }}%</span>
            </div>
        </div>

        <div class="mt-6 space-y-2">
            <a href="{{ route('admin.users.edit', $user) }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Edit User
            </a>
            @if($user->id !== auth()->id())
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete User
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Learning Progress -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Module Progress -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold mb-4">Module Progress</h3>
            <div class="space-y-4">
                @foreach($modules as $module)
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium">{{ $module->icon }} {{ $module->title }}</span>
                        <span class="text-sm font-bold text-blue-600">{{ $module->user_progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full transition-all" style="width: {{ $module->user_progress }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Quiz Attempts -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold mb-4">Recent Quiz Attempts</h3>
            <div class="space-y-4">
                @forelse($user->quizAttempts->take(10) as $attempt)
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium">{{ $attempt->quiz->title }}</p>
                        <p class="text-sm text-gray-600">{{ $attempt->quiz->module->title }} • {{ $attempt->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-medium {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $attempt->score }}%
                    </span>
                </div>
                @empty
                <p class="text-center text-gray-500">No quiz attempts yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection