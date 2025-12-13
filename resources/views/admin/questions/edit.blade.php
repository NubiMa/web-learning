@extends('layouts.admin')

@section('title', 'Edit Question')
@section('page-title', 'Edit Question')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.questions.update', $question) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                <textarea name="question" id="question" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('question', $question->question) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
                @for($i = 0; $i < 4; $i++)
                <div class="mb-2">
                    <input type="text" name="options[]" placeholder="Option {{ chr(65 + $i) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" value="{{ old('options.' . $i, $question->options[$i] ?? '') }}">
                </div>
                @endfor
            </div>

            <div class="mb-4">
                <label for="correct_answer" class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                <select name="correct_answer" id="correct_answer" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="0" {{ $question->correct_answer == 0 ? 'selected' : '' }}>Option A</option>
                    <option value="1" {{ $question->correct_answer == 1 ? 'selected' : '' }}>Option B</option>
                    <option value="2" {{ $question->correct_answer == 2 ? 'selected' : '' }}>Option C</option>
                    <option value="3" {{ $question->correct_answer == 3 ? 'selected' : '' }}>Option D</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">Explanation (optional)</label>
                <textarea name="explanation" id="explanation" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('explanation', $question->explanation) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $question->order) }}" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.quizzes.show', $question->quiz_id) }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update Question</button>
            </div>
        </form>
    </div>
</div>
@endsection