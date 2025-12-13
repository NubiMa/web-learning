@extends('layouts.admin')

@section('title', 'Edit Quiz')
@section('page-title', 'Edit Quiz')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.quizzes.update', $quiz) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="module_id" class="block text-sm font-medium text-gray-700 mb-2">Module</label>
                <select name="module_id" id="module_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ $quiz->module_id == $module->id ? 'selected' : '' }}>
                        {{ $module->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Quiz Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $quiz->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="passing_score" class="block text-sm font-medium text-gray-700 mb-2">Passing Score (%)</label>
                <input type="number" name="passing_score" id="passing_score" value="{{ old('passing_score', $quiz->passing_score) }}" min="0" max="100" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label for="time_limit" class="block text-sm font-medium text-gray-700 mb-2">Time Limit (minutes, optional)</label>
                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', $quiz->time_limit) }}" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">Leave empty for unlimited time</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.quizzes.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Quiz</button>
            </div>
        </form>
    </div>
</div>
@endsection