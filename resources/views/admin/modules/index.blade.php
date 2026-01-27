@extends('layouts.admin')

@section('title', 'Modules')
@section('page-title', 'Modules Management')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Search Bar -->
        <div class="relative w-full md:w-96">
            <input type="text" placeholder="Search modules..." data-admin-search="table"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <!-- Create Button -->
        <a href="{{ route('admin.modules.create') }}"
            class="inline-flex w-full md:w-auto items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Module
        </a>
    </div>

    <div class="bg-gray-50 md:bg-white rounded-lg shadow-none md:shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 hidden md:table-header-group">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Chapters</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody
                class="bg-transparent md:bg-white divide-y divide-gray-200 block md:table-row-group space-y-4 md:space-y-0 text-gray-600">
                @foreach ($modules as $module)
                    <tr
                        class="bg-white md:bg-transparent block md:table-row rounded-xl shadow-sm md:shadow-none p-4 md:p-0 border border-gray-100 md:border-none">
                        <td class="px-4 py-3 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex items-center">
                                <span
                                    class="text-3xl mr-3 flex items-center justify-center w-10 h-10 bg-gray-50 rounded-lg md:bg-transparent md:rounded-none">
                                    @if (Str::startsWith($module->icon, 'devicon-'))
                                        <i class="{{ $module->icon }} colored"></i>
                                    @else
                                        {{ $module->icon }}
                                    @endif
                                </span>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">{{ $module->title }}</div>
                                    <div class="text-xs md:text-sm text-gray-500 line-clamp-1">{{ $module->description }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <span
                                class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Chapters:</span>
                            <span class="text-sm text-gray-900">{{ $module->chapters_count }} chapters</span>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <span
                                class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Order:</span>
                            <span class="text-sm text-gray-900">{{ $module->order }}</span>
                        </td>
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex items-center justify-between md:justify-start">
                                <span
                                    class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2">Status:</span>
                                <form action="{{ route('admin.modules.toggle', $module) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $module->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $module->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td
                            class="px-4 py-3 md:px-6 md:py-4 block md:table-cell border-t border-gray-100 md:border-none mt-2 md:mt-0 pt-3 md:pt-4">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('admin.modules.show', $module) }}"
                                    class="text-blue-600 hover:text-blue-900 text-sm font-medium">View</a>
                                <a href="{{ route('admin.modules.edit', $module) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.modules.destroy', $module) }}" method="POST" class="inline"
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
@endsection
