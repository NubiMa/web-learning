@extends('layouts.admin')

@section('title', 'Edit Module')
@section('page-title', 'Edit Module: ' . $module->title)

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.modules.update', $module) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $module->title) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description', $module->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon (Programming
                        Language)</label>
                    <div class="relative">
                        <select name="icon" id="icon"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-mono">
                            <option value="">Select an icon...</option>
                            <optgroup label="Web Development">
                                <option value="devicon-html5-plain"
                                    {{ old('icon', $module->icon) == 'devicon-html5-plain' ? 'selected' : '' }}>HTML5
                                </option>
                                <option value="devicon-css3-plain"
                                    {{ old('icon', $module->icon) == 'devicon-css3-plain' ? 'selected' : '' }}>CSS3</option>
                                <option value="devicon-javascript-plain"
                                    {{ old('icon', $module->icon) == 'devicon-javascript-plain' ? 'selected' : '' }}>
                                    JavaScript</option>
                                <option value="devicon-typescript-plain"
                                    {{ old('icon', $module->icon) == 'devicon-typescript-plain' ? 'selected' : '' }}>
                                    TypeScript</option>
                                <option value="devicon-php-plain"
                                    {{ old('icon', $module->icon) == 'devicon-php-plain' ? 'selected' : '' }}>PHP</option>
                                <option value="devicon-python-plain"
                                    {{ old('icon', $module->icon) == 'devicon-python-plain' ? 'selected' : '' }}>Python
                                </option>
                                <option value="devicon-ruby-plain"
                                    {{ old('icon', $module->icon) == 'devicon-ruby-plain' ? 'selected' : '' }}>Ruby</option>
                                <option value="devicon-java-plain"
                                    {{ old('icon', $module->icon) == 'devicon-java-plain' ? 'selected' : '' }}>Java
                                </option>
                            </optgroup>
                            <optgroup label="Frameworks & Libs">
                                <option value="devicon-laravel-original"
                                    {{ old('icon', $module->icon) == 'devicon-laravel-original' ? 'selected' : '' }}>
                                    Laravel</option>
                                <option value="devicon-react-original"
                                    {{ old('icon', $module->icon) == 'devicon-react-original' ? 'selected' : '' }}>React
                                </option>
                                <option value="devicon-vuejs-plain"
                                    {{ old('icon', $module->icon) == 'devicon-vuejs-plain' ? 'selected' : '' }}>Vue.js
                                </option>
                                <option value="devicon-angularjs-plain"
                                    {{ old('icon', $module->icon) == 'devicon-angularjs-plain' ? 'selected' : '' }}>Angular
                                </option>
                                <option value="devicon-tailwindcss-original"
                                    {{ old('icon', $module->icon) == 'devicon-tailwindcss-original' ? 'selected' : '' }}>
                                    Tailwind CSS</option>
                                <option value="devicon-bootstrap-plain"
                                    {{ old('icon', $module->icon) == 'devicon-bootstrap-plain' ? 'selected' : '' }}>
                                    Bootstrap</option>
                            </optgroup>
                            <optgroup label="Tools & Databases">
                                <option value="devicon-git-plain"
                                    {{ old('icon', $module->icon) == 'devicon-git-plain' ? 'selected' : '' }}>Git</option>
                                <option value="devicon-mysql-plain"
                                    {{ old('icon', $module->icon) == 'devicon-mysql-plain' ? 'selected' : '' }}>MySQL
                                </option>
                                <option value="devicon-postgresql-plain"
                                    {{ old('icon', $module->icon) == 'devicon-postgresql-plain' ? 'selected' : '' }}>
                                    PostgreSQL</option>
                                <option value="devicon-docker-plain"
                                    {{ old('icon', $module->icon) == 'devicon-docker-plain' ? 'selected' : '' }}>Docker
                                </option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <select name="color" id="color" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="blue" {{ $module->color == 'blue' ? 'selected' : '' }}>Blue</option>
                        <option value="green" {{ $module->color == 'green' ? 'selected' : '' }}>Green</option>
                        <option value="yellow" {{ $module->color == 'yellow' ? 'selected' : '' }}>Yellow</option>
                        <option value="red" {{ $module->color == 'red' ? 'selected' : '' }}>Red</option>
                        <option value="purple" {{ $module->color == 'purple' ? 'selected' : '' }}>Purple</option>
                        <option value="orange" {{ $module->color == 'orange' ? 'selected' : '' }}>Orange</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $module->order) }}"
                        min="0" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.modules.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update
                        Module</button>
                </div>
            </form>
        </div>
    </div>
@endsection
