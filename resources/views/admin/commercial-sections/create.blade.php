@extends('layouts.admin')

@section('title', 'Create Commercial Section')
@section('page-title', 'Create Commercial Section')
@section('page-description', 'Add a new commercial showcase section')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Create New Commercial Section</h2>
                <a href="{{ route('admin.commercial-sections.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.commercial-sections.store') }}" method="POST" id="commercialForm" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="badge" class="block text-sm font-medium text-gray-700 mb-2">Badge Text *</label>
                    <input type="text" name="badge" id="badge" value="{{ old('badge', 'Commercial Expertise') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('badge') border-red-500 @enderror" 
                           placeholder="Commercial Expertise"
                           required>
                    @error('badge')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="is_active" id="is_active" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('is_active') border-red-500 @enderror">
                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('is_active')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       placeholder="Premium Commercial Properties — Strategic & Business-Ready Spaces"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('title') border-red-500 @enderror" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle *</label>
                <textarea name="subtitle" id="subtitle" rows="3" 
                          placeholder="We also work on commercial real estate solutions..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('subtitle') border-red-500 @enderror" required>{{ old('subtitle') }}</textarea>
                @error('subtitle')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Points Section -->
            <div class="pt-6 border-t border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-2">Commercial Points *</label>
                <div id="pointsContainer">
                    @if(old('points'))
                        @foreach(old('points') as $index => $point)
                        <div class="point-item border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm font-medium text-gray-700">Point {{ $index + 1 }}</h4>
                                <button type="button" class="remove-point text-red-600 hover:text-red-800" onclick="removePoint(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <input type="text" name="points[{{ $index }}][title]" value="{{ $point['title'] ?? '' }}" 
                                           placeholder="Point title" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <textarea name="points[{{ $index }}][description]" rows="2" 
                                              placeholder="Point description (optional)" class="w-full px-3 py-2 border border-gray-300 rounded-lg">{{ $point['description'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="point-item border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm font-medium text-gray-700">Point 1</h4>
                                <button type="button" class="remove-point text-red-600 hover:text-red-800" onclick="removePoint(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <input type="text" name="points[0][title]" value="Offices & Corporate Spaces" 
                                           placeholder="Point title" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <textarea name="points[0][description]" rows="2" 
                                              placeholder="Point description (optional)" class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" id="addPoint" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Point
                </button>
                @error('points')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button Settings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
                <div>
                    <label for="primary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Primary Button Text *</label>
                    <input type="text" name="primary_button_text" id="primary_button_text" 
                           value="{{ old('primary_button_text', 'Request Commercial Consultation') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('primary_button_text') border-red-500 @enderror" required>
                    @error('primary_button_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="primary_button_link" class="block text-sm font-medium text-gray-700 mb-2">Primary Button Link *</label>
                    <input type="text" name="primary_button_link" id="primary_button_link" 
                           value="{{ old('primary_button_link', '#contact') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('primary_button_link') border-red-500 @enderror" required>
                    @error('primary_button_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="secondary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text *</label>
                    <input type="text" name="secondary_button_text" id="secondary_button_text" 
                           value="{{ old('secondary_button_text', 'View Our Work') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('secondary_button_text') border-red-500 @enderror" required>
                    @error('secondary_button_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="secondary_button_link" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Link *</label>
                    <input type="text" name="secondary_button_link" id="secondary_button_link" 
                           value="{{ old('secondary_button_link', '#projects') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('secondary_button_link') border-red-500 @enderror" required>
                    @error('secondary_button_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="pt-6 border-t border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                
                <!-- Upload Images Section -->
                <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Upload New Images</h4>
                    <div id="uploadContainer">
                        <div class="upload-item border border-gray-200 rounded-lg p-4 mb-4 bg-white">
                            <div class="flex items-center justify-between mb-3">
                                <h5 class="text-sm font-medium text-gray-700">Upload Image 1</h5>
                                <button type="button" class="remove-upload text-red-600 hover:text-red-800" onclick="removeUpload(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Image File</label>
                                    <input type="file" name="uploaded_images[]" accept="image/*" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Alt Text</label>
                                        <input type="text" name="uploaded_image_alts[]" placeholder="Commercial property image" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                                        <input type="text" name="uploaded_image_labels[]" placeholder="Commercial project image" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addUpload" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Upload Slot
                    </button>
                </div>

                <!-- Manual Images Section -->
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Manual Image Paths (Optional)</h4>
                    <div id="imagesContainer">
                    @if(old('gallery_images'))
                        @foreach(old('gallery_images') as $index => $image)
                        <div class="image-item border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm font-medium text-gray-700">Image {{ $index + 1 }}</h4>
                                <button type="button" class="remove-image text-red-600 hover:text-red-800" onclick="removeImage(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <input type="text" name="gallery_images[{{ $index }}][src]" value="{{ $image['src'] ?? '' }}" 
                                           placeholder="main/images/commercial-1.png" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <input type="text" name="gallery_images[{{ $index }}][alt]" value="{{ $image['alt'] ?? '' }}" 
                                           placeholder="Alt text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <input type="text" name="gallery_images[{{ $index }}][label]" value="{{ $image['label'] ?? '' }}" 
                                           placeholder="Image label" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="image-item border border-gray-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-sm font-medium text-gray-700">Image 1</h4>
                                <button type="button" class="remove-image text-red-600 hover:text-red-800" onclick="removeImage(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <div>
                                    <input type="text" name="gallery_images[0][src]" value="main/images/commercial-1.png" 
                                           placeholder="main/images/commercial-1.png" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <input type="text" name="gallery_images[0][alt]" value="Commercial property workspace interior" 
                                           placeholder="Alt text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                                <div>
                                    <input type="text" name="gallery_images[0][label]" value="Commercial project image 1" 
                                           placeholder="Image label" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" id="addImage" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Manual Image
                </button>
                </div>
                @error('gallery_images')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gallery_note" class="block text-sm font-medium text-gray-700 mb-2">Gallery Note *</label>
                <input type="text" name="gallery_note" id="gallery_note" 
                       value="{{ old('gallery_note', 'Gallery Preview: Offices • Retail • Industrial • Investment Spaces') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('gallery_note') border-red-500 @enderror" required>
                @error('gallery_note')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.commercial-sections.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Commercial Section
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let pointIndex = {{ old('points') ? count(old('points')) : 1 }};
let imageIndex = {{ old('gallery_images') ? count(old('gallery_images')) : 0 }};
let uploadIndex = 1;

document.getElementById('addPoint').addEventListener('click', function() {
    const container = document.getElementById('pointsContainer');
    const pointHtml = `
        <div class="point-item border border-gray-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-medium text-gray-700">Point ${pointIndex + 1}</h4>
                <button type="button" class="remove-point text-red-600 hover:text-red-800" onclick="removePoint(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <input type="text" name="points[${pointIndex}][title]" placeholder="Point title" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                </div>
                <div>
                    <textarea name="points[${pointIndex}][description]" rows="2" placeholder="Point description (optional)" class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', pointHtml);
    pointIndex++;
});

document.getElementById('addUpload').addEventListener('click', function() {
    const container = document.getElementById('uploadContainer');
    const uploadHtml = `
        <div class="upload-item border border-gray-200 rounded-lg p-4 mb-4 bg-white">
            <div class="flex items-center justify-between mb-3">
                <h5 class="text-sm font-medium text-gray-700">Upload Image ${uploadIndex + 1}</h5>
                <button type="button" class="remove-upload text-red-600 hover:text-red-800" onclick="removeUpload(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Image File</label>
                    <input type="file" name="uploaded_images[]" accept="image/*" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Alt Text</label>
                        <input type="text" name="uploaded_image_alts[]" placeholder="Commercial property image" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                        <input type="text" name="uploaded_image_labels[]" placeholder="Commercial project image" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', uploadHtml);
    uploadIndex++;
});

document.getElementById('addImage').addEventListener('click', function() {
    const container = document.getElementById('imagesContainer');
    const imageHtml = `
        <div class="image-item border border-gray-200 rounded-lg p-4 mb-4">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-medium text-gray-700">Manual Image ${imageIndex + 1}</h4>
                <button type="button" class="remove-image text-red-600 hover:text-red-800" onclick="removeImage(this)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div>
                    <input type="text" name="gallery_images[${imageIndex}][src]" placeholder="main/images/commercial-${imageIndex + 1}.png" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <input type="text" name="gallery_images[${imageIndex}][alt]" placeholder="Alt text" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <input type="text" name="gallery_images[${imageIndex}][label]" placeholder="Image label" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', imageHtml);
    imageIndex++;
});

function removePoint(button) {
    button.closest('.point-item').remove();
}

function removeUpload(button) {
    button.closest('.upload-item').remove();
}

function removeImage(button) {
    button.closest('.image-item').remove();
}
</script>
@endsection