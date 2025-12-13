@extends('layouts.admin')

@section('title', 'Quizzes')
@section('page-title', 'Quizzes Management')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.quizzes.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Create Quiz
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quiz</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Module</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Questions</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passing Score</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($quizzes as $quiz)
            <tr>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $quiz->title }}</div>
                    <div class="text-sm text-gray-500">{{ Str::limit($quiz->description, 50) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ $quiz->module->title }}</span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $quiz->questions->count() }} questions</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $quiz->passing_score }}%</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('admin.quizzes.toggle', $quiz) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-sm {{ $quiz->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $quiz->is_active ? 'Active' : 'Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.quizzes.show', $quiz) }}" class="text-blue-600 hover:text-blue-900 mr-3">Manage</a>
                    <a href="{{ route('admin.quizzes.edit', $quiz) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection