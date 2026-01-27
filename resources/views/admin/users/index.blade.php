@extends('layouts.admin')

@section('title', 'Manage Users')
@section('page-title', 'Manage Users')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <!-- Search -->
        <div class="relative w-full md:w-96">
            <input type="text" placeholder="Search users..." data-admin-search="table"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>

        <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-3 w-full md:w-auto">
            <!-- Role Filter -->
            <select data-filter="table" data-filter-column="2"
                class="w-full sm:w-auto px-8 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="all">All</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>


            <!-- Add User Button -->
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex w-full sm:w-auto items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add User
            </a>
        </div>
    </div>

    <!-- Modern Table -->
    <div class="bg-gray-50 md:bg-white rounded-lg shadow-none md:shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 hidden md:table-header-group">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Joined Date
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody
                class="bg-transparent md:bg-white divide-y divide-gray-200 block md:table-row-group space-y-4 md:space-y-0 text-gray-600">
                @foreach ($users as $user)
                    <tr
                        class="bg-white md:bg-transparent block md:table-row rounded-xl shadow-sm md:shadow-none p-4 md:p-0 border border-gray-100 md:border-none hover:bg-gray-50 transition">
                        <!-- Name -->
                        <td class="px-4 py-3 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex items-center">
                                @if ($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile"
                                        class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div
                                        class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>

                        <!-- Email -->
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex md:block items-center">
                                <span
                                    class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2 w-20">Email:</span>
                                <div class="text-sm text-gray-700 truncate">{{ $user->email }}</div>
                            </div>
                        </td>

                        <!-- Role -->
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex md:block items-center">
                                <span
                                    class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2 w-20">Role:</span>
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role == 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </td>

                        <!-- Joined Date -->
                        <td class="px-4 py-2 md:px-6 md:py-4 block md:table-cell">
                            <div class="flex md:block items-center">
                                <span
                                    class="md:hidden text-xs font-semibold text-gray-500 uppercase tracking-wider mr-2 w-20">Joined:</span>
                                <span class="text-sm text-gray-600">{{ $user->created_at->format('Y-m-d') }}</span>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td
                            class="px-4 py-3 md:px-6 md:py-4 block md:table-cell border-t border-gray-100 md:border-none mt-2 md:mt-0 pt-3 md:pt-4">
                            <div class="flex items-center justify-end space-x-3">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="text-blue-600 hover:text-blue-900 p-2 md:p-0">
                                    <span class="md:hidden mr-1 text-sm font-medium">Edit</span>
                                    <svg class="w-5 h-5 hidden md:block" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 p-2 md:p-0 flex items-center">
                                        <span class="md:hidden mr-1 text-sm font-medium">Delete</span>
                                        <svg class="w-5 h-5 hidden md:block" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                <!-- no results row -->
                <tr id="noResults" style="display: none;">
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 block md:table-cell">
                        No users found matching your criteria.
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div
            class="bg-white px-6 py-4 border-t border-gray-200 flex flex-col md:flex-row items-center justify-between gap-4 md:gap-0">
            <div class="text-sm text-gray-700 w-full md:w-auto text-center md:text-left">
                Showing <span class="font-medium">{{ $users->firstItem() }}</span> to <span
                    class="font-medium">{{ $users->lastItem() }}</span> of <span
                    class="font-medium">{{ $users->total() }}</span> users
            </div>
            <div class="flex space-x-2 w-full md:w-auto justify-center md:justify-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
