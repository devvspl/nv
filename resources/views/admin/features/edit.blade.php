@extends('layouts.admin')

@section('title', 'Edit Feature')
@section('page-title', 'Edit Feature')
@section('page-description', 'Update feature information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Edit Feature</h2>
                <a href="{{ route('admin.features.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.features.update', $feature) }}" method="POST" class="p-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $feature->title) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('title') border-red-500 @enderror"
                       placeholder="Enter the feature title"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea name="description" 
                          id="description" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Enter the feature description"
                          required>{{ old('description', $feature->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                
                <!-- Current Uploaded Icon -->
                @if($feature->icon_upload)
                <div class="mb-3 p-4 border border-blue-200 rounded-lg bg-blue-50">
                    <label class="block text-xs font-medium text-gray-600 mb-2">Current Uploaded Icon</label>
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('storage/' . $feature->icon_upload) }}" alt="Current Icon" class="w-16 h-16 object-contain border border-gray-200 rounded-lg p-2 bg-white">
                        <div class="flex-1">
                            <p class="text-xs text-gray-600">{{ basename($feature->icon_upload) }}</p>
                            <label class="flex items-center mt-2 text-xs text-red-600 cursor-pointer">
                                <input type="checkbox" name="remove_icon_upload" value="1" class="mr-2">
                                Remove this icon
                            </label>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Upload New Icon Option -->
                <div class="mb-3 p-4 border border-gray-200 rounded-lg bg-gray-50">
                    <label class="block text-xs font-medium text-gray-600 mb-2">
                        {{ $feature->icon_upload ? 'Upload New Icon' : 'Upload Icon File' }}
                    </label>
                    <input type="file" 
                           name="icon_upload" 
                           id="icon_upload"
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('icon_upload') border-red-500 @enderror"
                           onchange="previewIcon(this)">
                    <p class="mt-1 text-xs text-gray-500">Upload an icon image (jpeg, png, jpg, gif, svg, webp, max 2MB)</p>
                    @error('icon_upload')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Icon Preview -->
                    <div id="iconPreview" class="mt-3 hidden">
                        <p class="text-xs font-medium text-gray-600 mb-2">Preview:</p>
                        <img id="iconPreviewImage" src="" alt="Icon preview" class="w-16 h-16 object-contain border border-gray-200 rounded-lg p-2 bg-white">
                    </div>
                </div>
                
                <!-- Manual Icon Path Option -->
                <div class="p-4 border border-gray-200 rounded-lg">
                    <label for="icon" class="block text-xs font-medium text-gray-600 mb-2">Or Enter Icon Path</label>
                    <div class="flex items-center space-x-3">
                        <div class="flex-1">
                            <input type="text" 
                                   name="icon" 
                                   id="icon" 
                                   value="{{ old('icon', $feature->icon) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('icon') border-red-500 @enderror"
                                   placeholder="e.g., Budget-Friendly.svg or main/icons/Budget-Friendly.svg">
                        </div>
                        @if($feature->icon && !$feature->icon_upload)
                            <div class="flex-shrink-0">
                                <img src="{{ $feature->icon_url }}" alt="Current Icon" class="w-12 h-12 border border-gray-200 rounded-lg p-2">
                            </div>
                        @endif
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Enter the icon filename (e.g., Budget-Friendly.svg) or full path. Icons should be placed in public/main/icons/</p>
                    @error('icon')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tag -->
            <div>
                <label for="tag" class="block text-sm font-medium text-gray-700 mb-2">Tag</label>
                <select name="tag" 
                        id="tag" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('tag') border-red-500 @enderror">
                    <option value="">Select a tag (optional)</option>
                    <option value="why-choose-us" {{ old('tag', $feature->tag) == 'why-choose-us' ? 'selected' : '' }}>Why Choose Us</option>
                    <option value="our-services" {{ old('tag', $feature->tag) == 'our-services' ? 'selected' : '' }}>Our Services
</option>
                </select>
                <p class="mt-1 text-sm text-gray-500">Tag determines which section this feature appears in. "Why Choose Us" shows in grid layout, "Our Services
" shows in list layout.</p>
                @error('tag')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Settings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" 
                           name="sort_order" 
                           id="sort_order" 
                           value="{{ old('sort_order', $feature->sort_order) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('sort_order') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first. Default is 0.</p>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', $feature->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Active (visible on website)
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.features.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Feature
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewIcon(input) {
    const preview = document.getElementById('iconPreview');
    const previewImage = document.getElementById('iconPreviewImage');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection