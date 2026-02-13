@extends('layouts.admin')

@section('title', 'Create Builder')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Create New Builder</h2>
                <a href="{{ route('admin.builders.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.builders.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Basic Information</h3>
            
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Builder Name *</label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name') }}" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="e.g., Lodha Group, DLF Limited">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="established_year" class="block text-sm font-medium text-gray-700 mb-2">Established Year</label>
                        <input type="number" 
                               name="established_year" 
                               id="established_year"
                               value="{{ old('established_year') }}" 
                               min="1800" 
                               max="{{ date('Y') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('established_year') border-red-500 @enderror"
                               placeholder="e.g., 1995">
                        @error('established_year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" 
                              id="description"
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Brief description about the builder">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                    <input type="file" 
                           name="logo" 
                           id="logo"
                           accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('logo') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Accepted formats: JPEG, PNG, JPG, WEBP. Max size: 2MB</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Contact Information -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
            
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email"
                               value="{{ old('email') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="contact@builder.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" 
                               name="phone" 
                               id="phone"
                               value="{{ old('phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('phone') border-red-500 @enderror"
                               placeholder="+91 1234567890">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" 
                           name="website" 
                           id="website"
                           value="{{ old('website') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('website') border-red-500 @enderror"
                           placeholder="https://www.builder.com">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" 
                              id="address"
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('address') border-red-500 @enderror"
                              placeholder="Office address">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Settings -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings</h3>
            
                <div>
                    <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" 
                           name="display_order" 
                           id="display_order"
                           value="{{ old('display_order', 0) }}" 
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('display_order') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                    @error('display_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-3">
                    <div class="flex items-center">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" 
                               name="status" 
                               id="status" 
                               value="1" 
                               {{ old('status', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                        <label for="status" class="ml-2 block text-sm text-gray-700">
                            Active (visible on website)
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="is_verified" value="0">
                        <input type="checkbox" 
                               name="is_verified" 
                               id="is_verified" 
                               value="1" 
                               {{ old('is_verified') ? 'checked' : '' }}
                               class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                        <label for="is_verified" class="ml-2 block text-sm text-gray-700">
                            Verified Builder
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.builders.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Builder
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
