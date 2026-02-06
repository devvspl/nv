@extends('layouts.admin')

@section('title', 'Edit Testimonial')
@section('page-title', 'Edit Testimonial')
@section('page-description', 'Update customer testimonial')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Edit Testimonial</h2>
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Current Info Display -->
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                @if($testimonial->avatar)
                    <img class="w-16 h-16 rounded-full object-cover" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                @else
                    <div class="w-16 h-16 bg-zendo-gold rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">{{ $testimonial->initials }}</span>
                    </div>
                @endif
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $testimonial->name }}</h3>
                    <p class="text-gray-600">{{ $testimonial->full_title }}</p>
                    <p class="text-sm text-gray-500">Created {{ $testimonial->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Client Name *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $testimonial->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="Enter client name"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position/Title *</label>
                    <input type="text" 
                           name="position" 
                           id="position" 
                           value="{{ old('position', $testimonial->position) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('position') border-red-500 @enderror"
                           placeholder="e.g., Marketing Manager"
                           required>
                    @error('position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Company -->
            <div>
                <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                <input type="text" 
                       name="company" 
                       id="company" 
                       value="{{ old('company', $testimonial->company) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('company') border-red-500 @enderror"
                       placeholder="e.g., Tech Corp">
                @error('company')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Testimonial Content *</label>
                <textarea name="content" 
                          id="content" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('content') border-red-500 @enderror"
                          placeholder="Enter the testimonial content..."
                          required>{{ old('content', $testimonial->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Avatar -->
            <div>
                <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Client Photo</label>
                @if($testimonial->avatar)
                    <div class="mb-3">
                        <img class="w-20 h-20 rounded-lg object-cover" src="{{ Storage::url($testimonial->avatar) }}" alt="Current avatar">
                        <p class="text-sm text-gray-500 mt-1">Current photo</p>
                    </div>
                @endif
                <input type="file" 
                       name="avatar" 
                       id="avatar" 
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('avatar') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Upload a new photo to replace the current one (JPEG, PNG, JPG, GIF - Max: 2MB)</p>
                @error('avatar')
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
                           value="{{ old('sort_order', $testimonial->sort_order) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('sort_order') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first (0 = highest priority)</p>
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
                           {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Active (visible on website)
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Testimonial
                </button>
            </div>
        </form>
    </div>
</div>
@endsection