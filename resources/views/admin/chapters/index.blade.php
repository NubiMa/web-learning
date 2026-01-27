@extends('layouts.admin')

@section('title', 'Chapters')
@section('page-title', 'Chapters Management')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Search Bar -->
        <div class="relative w-full md:w-96">
            <input type="text" placeholder="Search chapters..." data-admin-search="table"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Create Button -->
        <a href="{{ route('admin.chapters.create') }}"
            class="inline-flex w-full md:w-auto items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Chapter
        </a>
    </div>

    <div class="bg-gray-50 md:bg-white rounded-lg shadow-none md:shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 hidden md:table-header-group">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chapter</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Module</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody
                class="bg-transparent md:bg-white divide-y divide-gray-200 block md:table-row-group space-y-4 md:space-y-0 text-gray-600">
                @foreach ($chapters as $chapter)
                    <tr
                        class="bg-white md:bg-transparent block md:table-row rounded-xl shadow-sm md:shadow-none p-4 md:p-0 border border-gray-100 md:border-none">
                        <td class="px-4 py-3 md:px-6 md:py-4 block md:table-cell">
                            <div class="text-sm font-bold text-gray-900">{{ $chapter->title }}</div>
                            <div class="text-xs md:text-sm text-gray-500 line-clamp-2 md:line-clamp-1">
                                {{ Str::limit(strip_tags($chapter->content), 80) }}</div>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <span
                                class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Module:</span>
                            <span
                                class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">{{ $chapter->module->title }}</span>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <span
                                class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Order:</span>
                            <span class="text-sm text-gray-900">{{ $chapter->order }}</span>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex items-center justify-between md:justify-start">
                                <span
                                    class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Status:</span>
                                <form action="{{ route('admin.chapters.toggle', $chapter) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $chapter->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $chapter->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td
                            class="px-4 py-3 md:px-6 md:py-4 block md:table-cell border-t border-gray-100 md:border-none mt-2 md:mt-0 pt-3 md:pt-4">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.chapters.edit', $chapter) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.chapters.destroy', $chapter) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $chapters->links() }}
    </div>
@endsection
