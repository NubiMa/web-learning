@extends('layouts.admin')

@section('title', 'Edit Question')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Question</h1>
            <form action="{{ route('admin.questions.update', $question) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                    <textarea name="question" id="question" rows="3" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('question', $question->question) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Question Image (optional)</label>

                    @if ($question->image)
                        <div class="mb-3 flex items-start space-x-4">
                            <div>
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Current question image"
                                    class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                                <label class="flex items-center mt-2">
                                    <input type="checkbox" name="remove_image" value="1"
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500"
                                        onchange="toggleImageUpload(this)">
                                    <span class="ml-2 text-sm text-red-600">Remove image</span>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div id="imageUploadSection">
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <input type="file" name="image" id="image"
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    onchange="previewImage(event)">
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $question->image ? 'Upload a new image to replace the current one' : 'Accepted formats: JPEG, PNG, GIF (max 2MB)' }}
                                </p>
                            </div>
                            <div id="imagePreview" class="hidden">
                                <img id="preview" src="" alt="Image preview"
                                    class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Options</label>
                    @for ($i = 0; $i < 4; $i++)
                        <div class="mb-2">
                            <input type="text" name="options[]" placeholder="Option {{ chr(65 + $i) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                value="{{ old('options.' . $i, $question->options[$i] ?? '') }}">
                        </div>
                    @endfor
                </div>

                <div class="mb-4">
                    <label for="correct_answer" class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                    <select name="correct_answer" id="correct_answer" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="0" {{ $question->correct_answer == 0 ? 'selected' : '' }}>Option A</option>
                        <option value="1" {{ $question->correct_answer == 1 ? 'selected' : '' }}>Option B</option>
                        <option value="2" {{ $question->correct_answer == 2 ? 'selected' : '' }}>Option C</option>
                        <option value="3" {{ $question->correct_answer == 3 ? 'selected' : '' }}>Option D</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">Explanation
                        (optional)</label>
                    <textarea name="explanation" id="explanation" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('explanation', $question->explanation) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $question->order) }}"
                        min="1" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_draft" value="1"
                            {{ old('is_draft', $question->is_draft) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Save as Draft (won't be visible to users)</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.quizzes.show', $question->quiz_id) }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Update
                        Question</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    document.getElementById('imagePreview').classList.add('hidden');
                }
            }

            function toggleImageUpload(checkbox) {
                const uploadSection = document.getElementById('imageUploadSection');
                const imageInput = document.getElementById('image');

                if (checkbox.checked) {
                    uploadSection.style.opacity = '0.5';
                    uploadSection.style.pointerEvents = 'none';
                    imageInput.disabled = true;
                } else {
                    uploadSection.style.opacity = '1';
                    uploadSection.style.pointerEvents = 'auto';
                    imageInput.disabled = false;
                }
            }
        </script>
    @endpush
