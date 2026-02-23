@extends('layouts.admin')

@section('title', 'Create Property Page Section')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-heading text-zendo-navy font-bold">Create Property Page Section</h1>
    <p class="text-gray-600 mt-1">Add a new section to the properties page</p>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('admin.property-page-sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Section Key -->
            <div>
                <label for="section_key" class="block text-sm font-medium text-gray-700 mb-2">Section Key *</label>
                <select name="section_key" id="section_key" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    <option value="">Select Section Key</option>
                    <option value="carousel_section" {{ old('section_key') == 'carousel_section' ? 'selected' : '' }}>Carousel Section</option>
                    <option value="perspective_section" {{ old('section_key') == 'perspective_section' ? 'selected' : '' }}>Perspective Section</option>
                </select>
                @error('section_key')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('subtitle')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Button Text -->
            <div>
                <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('button_text')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button Link -->
            <div>
                <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                <input type="text" name="button_link" id="button_link" value="{{ old('button_link') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('button_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Secondary Button Text -->
            <div>
                <label for="secondary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text</label>
                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('secondary_button_text')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Secondary Button Link -->
            <div>
                <label for="secondary_button_link" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Link</label>
                <input type="text" name="secondary_button_link" id="secondary_button_link" value="{{ old('secondary_button_link') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('secondary_button_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Images -->
        <div class="mt-6">
            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Images (Multiple)</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">You can select multiple images. Recommended: 4 images for perspective section, multiple for carousel.</p>
            @error('images.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Features -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Features (For Perspective Section)</label>
            <div id="features-container">
                <div class="feature-item mb-2">
                    <input type="text" name="features[]" placeholder="e.g., <strong>Connectivity:</strong> Main roads, expressways..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                </div>
            </div>
            <button type="button" onclick="addFeature()" class="mt-2 text-zendo-gold hover:text-zendo-navy text-sm font-semibold">+ Add Another Feature</button>
            <p class="text-xs text-gray-500 mt-1">You can use HTML tags like &lt;strong&gt; for bold text.</p>
        </div>

        <!-- Status -->
        <div class="mt-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.property-page-sections.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-zendo-gold hover:bg-zendo-navy text-white rounded-lg font-semibold transition-colors">
                Create Section
            </button>
        </div>
    </form>
</div>

<script>
function addFeature() {
    const container = document.getElementById('features-container');
    const div = document.createElement('div');
    div.className = 'feature-item mb-2 flex gap-2';
    div.innerHTML = `
        <input type="text" name="features[]" placeholder="e.g., <strong>Project Amenities:</strong> Clubhouse, gym..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
        <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Remove</button>
    `;
    container.appendChild(div);
}
</script>
@endsection
