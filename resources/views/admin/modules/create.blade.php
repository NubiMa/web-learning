@extends('layouts.admin')

@section('title', 'Create Module')
@section('page-title', 'Create New Module')

@section('content')
    <div class="max-w-3xl">
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.modules.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
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
                                    {{ old('icon') == 'devicon-html5-plain' ? 'selected' : '' }}>HTML5</option>
                                <option value="devicon-css3-plain"
                                    {{ old('icon') == 'devicon-css3-plain' ? 'selected' : '' }}>CSS3</option>
                                <option value="devicon-javascript-plain"
                                    {{ old('icon') == 'devicon-javascript-plain' ? 'selected' : '' }}>JavaScript</option>
                                <option value="devicon-typescript-plain"
                                    {{ old('icon') == 'devicon-typescript-plain' ? 'selected' : '' }}>TypeScript</option>
                                <option value="devicon-php-plain"
                                    {{ old('icon') == 'devicon-php-plain' ? 'selected' : '' }}>PHP</option>
                                <option value="devicon-python-plain"
                                    {{ old('icon') == 'devicon-python-plain' ? 'selected' : '' }}>Python</option>
                                <option value="devicon-ruby-plain"
                                    {{ old('icon') == 'devicon-ruby-plain' ? 'selected' : '' }}>Ruby</option>
                                <option value="devicon-java-plain"
                                    {{ old('icon') == 'devicon-java-plain' ? 'selected' : '' }}>Java</option>
                            </optgroup>
                            <optgroup label="Frameworks & Libs">
                                <option value="devicon-laravel-original"
                                    {{ old('icon') == 'devicon-laravel-original' ? 'selected' : '' }}>Laravel</option>
                                <option value="devicon-react-original"
                                    {{ old('icon') == 'devicon-react-original' ? 'selected' : '' }}>React</option>
                                <option value="devicon-vuejs-plain"
                                    {{ old('icon') == 'devicon-vuejs-plain' ? 'selected' : '' }}>Vue.js</option>
                                <option value="devicon-angularjs-plain"
                                    {{ old('icon') == 'devicon-angularjs-plain' ? 'selected' : '' }}>Angular</option>
                                <option value="devicon-tailwindcss-original"
                                    {{ old('icon') == 'devicon-tailwindcss-original' ? 'selected' : '' }}>Tailwind CSS
                                </option>
                                <option value="devicon-bootstrap-plain"
                                    {{ old('icon') == 'devicon-bootstrap-plain' ? 'selected' : '' }}>Bootstrap</option>
                            </optgroup>
                            <optgroup label="Tools & Databases">
                                <option value="devicon-git-plain"
                                    {{ old('icon') == 'devicon-git-plain' ? 'selected' : '' }}>Git</option>
                                <option value="devicon-mysql-plain"
                                    {{ old('icon') == 'devicon-mysql-plain' ? 'selected' : '' }}>MySQL</option>
                                <option value="devicon-postgresql-plain"
                                    {{ old('icon') == 'devicon-postgresql-plain' ? 'selected' : '' }}>PostgreSQL</option>
                                <option value="devicon-docker-plain"
                                    {{ old('icon') == 'devicon-docker-plain' ? 'selected' : '' }}>Docker</option>
                            </optgroup>
                        </select>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Select an icon from the Devicon library.</p>
                </div>

                <div class="mb-4">
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                    <select name="color" id="color" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="yellow">Yellow</option>
                        <option value="red">Red</option>
                        <option value="purple">Purple</option>
                        <option value="orange">Orange</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="0"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.modules.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Create
                        Module</button>
                </div>
            </form>
        </div>
    </div>
@endsection
