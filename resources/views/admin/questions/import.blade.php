@extends('layouts.admin')

@section('title', 'Import Questions from Excel')
@section('page-title', 'Import Questions to: ' . $quiz->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.show', $quiz) }}" class="text-blue-600 hover:text-blue-800">
            ← Back to Quiz
        </a>
    </div>

    <div class="bg-white rounded-lg shadow p-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-2">Import Questions from CSV/Excel</h2>
            <p class="text-gray-600">Upload a CSV file with your questions to add them in bulk.</p>
        </div>

        <!-- Download Template Section -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                </svg>
                <div class="flex-1">
                    <h3 class="font-medium text-blue-900 mb-2">Download Template</h3>
                    <p class="text-sm text-blue-800 mb-4">Start with our template to ensure correct formatting.</p>
                    <a href="{{ route('admin.questions.template') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download CSV Template
                    </a>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="mb-6">
            <h3 class="font-medium text-gray-900 mb-3">File Format Instructions:</h3>
            <div class="bg-gray-50 rounded-lg p-4 space-y-2 text-sm">
                <p><strong>Columns Required:</strong></p>
                <ol class="list-decimal list-inside space-y-1 ml-2">
                    <li>Question (required)</li>
                    <li>Option A (required)</li>
                    <li>Option B (required)</li>
                    <li>Option C (optional)</li>
                    <li>Option D (optional)</li>
                    <li>Correct Answer (required) - Enter A, B, C, or D</li>
                    <li>Explanation (optional)</li>
                    <li>Is Draft (optional) - Enter "Yes" or "No", defaults to "No"</li>
                </ol>
                <p class="mt-3"><strong class="text-yellow-700">Important:</strong> Save your Excel file as CSV format before uploading!</p>
            </div>
        </div>

        <!-- Upload Form -->
        <form action="{{ route('admin.questions.importPost', $quiz) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="excel_file" class="block text-sm font-medium text-gray-700 mb-2">
                    Upload CSV File
                </label>
                <input type="file" 
                       name="excel_file" 
                       id="excel_file" 
                       accept=".csv,.xls,.xlsx" 
                       required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                
                @error('excel_file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <p class="mt-1 text-xs text-gray-500">Accepted formats: CSV (.csv) - Max size: 2MB</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.quizzes.show', $quiz) }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Import Questions
                </button>
            </div>
        </form>
    </div>

    <!-- Example Preview -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h3 class="font-medium text-gray-900 mb-4">Example CSV Format:</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border text-left">Question</th>
                        <th class="px-3 py-2 border text-left">Option A</th>
                        <th class="px-3 py-2 border text-left">Option B</th>
                        <th class="px-3 py-2 border text-left">Option C</th>
                        <th class="px-3 py-2 border text-left">Option D</th>
                        <th class="px-3 py-2 border text-left">Correct Answer</th>
                        <th class="px-3 py-2 border text-left">Explanation</th>
                        <th class="px-3 py-2 border text-left">Is Draft</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-2 border">What is HTML?</td>
                        <td class="px-3 py-2 border">HyperText Markup Language</td>
                        <td class="px-3 py-2 border">High Tech Modern Language</td>
                        <td class="px-3 py-2 border">Home Tool Making Language</td>
                        <td class="px-3 py-2 border"></td>
                        <td class="px-3 py-2 border">A</td>
                        <td class="px-3 py-2 border">HTML is used for web pages</td>
                        <td class="px-3 py-2 border">No</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
