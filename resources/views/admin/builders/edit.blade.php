@extends('layouts.admin')

@section('title', 'Edit Builder')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Edit Builder</h2>
                <a href="{{ route('admin.builders.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.builders.update', $builder) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Basic Information</h3>
            
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Builder Name *</label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               value="{{ old('name', $builder->name) }}" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="established_year" class="block text-sm font-medium text-gray-700 mb-2">Established Year</label>
                        <input type="number" 
                               name="established_year" 
                               id="established_year"
                               value="{{ old('established_year', $builder->established_year) }}" 
                               min="1800" 
                               max="{{ date('Y') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('established_year') border-red-500 @enderror">
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
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $builder->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if($builder->logo)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Logo</label>
                    <img src="{{ asset('storage/' . $builder->logo) }}" alt="{{ $builder->name }}" 
                         class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                </div>
                @endif

                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">{{ $builder->logo ? 'Change Logo' : 'Upload Logo' }}</label>
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
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $builder->email) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $builder->phone) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                    <input type="url" name="website" value="{{ old('website', $builder->website) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea name="address" rows="2"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('address', $builder->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-heading font-semibold text-zendo-navy mb-4">Settings</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $builder->display_order) }}" min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                    @error('display_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ old('status', $builder->status) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                        <span class="text-sm font-medium text-gray-700">Active</span>
                    </label>
                </div>

                <div>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $builder->is_verified) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                        <span class="text-sm font-medium text-gray-700">Verified Builder</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500 ml-6">Mark this builder as verified/trusted</p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.builders.index') }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-zendo-gold text-white rounded-lg hover:bg-zendo-navy transition-colors">
                Update Builder
            </button>
        </div>
    </form>
</div>
@endsection
