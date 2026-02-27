@extends('layouts.admin')

@section('title', 'Edit Property Page Section')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-heading text-zendo-navy font-bold">Edit Property Page Section</h1>
    <p class="text-gray-600 mt-1">Update section details for <span class="font-semibold text-zendo-gold">{{ ucwords(str_replace('_', ' ', $propertyPageSection->section_key)) }}</span></p>
</div>


<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('admin.property-page-sections.update', $propertyPageSection) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Section Key -->
            <div>
                <label for="section_key" class="block text-sm font-medium text-gray-700 mb-2">Section Key *</label>
                <input type="text" name="section_key" id="section_key" value="{{ $propertyPageSection->section_key }}" readonly class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">Section key cannot be changed</p>
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $propertyPageSection->order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $propertyPageSection->title) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $propertyPageSection->subtitle) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('subtitle')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('description', $propertyPageSection->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Button Text -->
            <div>
                <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                <input type="text" name="button_text" id="button_text" value="{{ old('button_text', $propertyPageSection->button_text) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('button_text')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button Link -->
            <div>
                <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                <input type="text" name="button_link" id="button_link" value="{{ old('button_link', $propertyPageSection->button_link) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('button_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Secondary Button Text -->
            <div>
                <label for="secondary_button_text" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Text</label>
                <input type="text" name="secondary_button_text" id="secondary_button_text" value="{{ old('secondary_button_text', $propertyPageSection->secondary_button_text) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('secondary_button_text')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Secondary Button Link -->
            <div>
                <label for="secondary_button_link" class="block text-sm font-medium text-gray-700 mb-2">Secondary Button Link</label>
                <input type="text" name="secondary_button_link" id="secondary_button_link" value="{{ old('secondary_button_link', $propertyPageSection->secondary_button_link) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                @error('secondary_button_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Existing Images -->
        @if($propertyPageSection->images && count($propertyPageSection->images) > 0)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($propertyPageSection->images_urls as $index => $imageUrl)
                        <div class="relative">
                            <img src="{{ $imageUrl }}" alt="Image {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg">
                            <form action="{{ route('admin.property-page-sections.delete-image', $propertyPageSection) }}" method="POST" class="absolute top-2 right-2" onsubmit="return confirm('Delete this image?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="image_index" value="{{ $index }}">
                                <button type="submit" class="bg-red-500 text-white p-1 rounded-full hover:bg-red-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Add New Images -->
        <div class="mt-6">
            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Add More Images</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">You can select multiple images to add.</p>
            @error('images.*')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Features -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Features (For Perspective Section)</label>
            <div id="features-container">
                @if($propertyPageSection->features && count($propertyPageSection->features) > 0)
                    @foreach($propertyPageSection->features as $feature)
                        <div class="feature-item mb-2 flex gap-2">
                            <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Remove</button>
                        </div>
                    @endforeach
                @else
                    <div class="feature-item mb-2">
                        <input type="text" name="features[]" placeholder="e.g., <strong>Connectivity:</strong> Main roads, expressways..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    </div>
                @endif
            </div>
            <button type="button" onclick="addFeature()" class="mt-2 text-zendo-gold hover:text-zendo-navy text-sm font-semibold">+ Add Another Feature</button>
            <p class="text-xs text-gray-500 mt-1">You can use HTML tags like &lt;strong&gt; for bold text.</p>
        </div>

        <!-- Status -->
        <div class="mt-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $propertyPageSection->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.property-page-sections.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-zendo-gold hover:bg-zendo-navy text-white rounded-lg font-semibold transition-colors">
                Update Section
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
