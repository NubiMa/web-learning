@extends('layouts.admin')

@section('title', 'Create Chapter')
@section('page-title', 'Create New Chapter')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.chapters.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="module_id" class="block text-sm font-medium text-gray-700 mb-2">Module</label>
                <select name="module_id" id="module_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Module</option>
                    @foreach($modules as $module)
                    <option value="{{ $module->id }}" {{ old('module_id') == $module->id ? 'selected' : '' }}>{{ $module->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" id="content" rows="8" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ old('content') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Main content/explanation of the chapter</p>
            </div>

            <div class="mb-4">
                <label for="code_example" class="block text-sm font-medium text-gray-700 mb-2">Code Example</label>
                <textarea name="code_example" id="code_example" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ old('code_example') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Code example for this chapter</p>
            </div>

            <div class="mb-4">
                <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">Explanation</label>
                <textarea name="explanation" id="explanation" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('explanation') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Additional explanation for the code example</p>
            </div>

            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.chapters.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create Chapter</button>
            </div>
        </form>
    </div>
</div>
@endsection