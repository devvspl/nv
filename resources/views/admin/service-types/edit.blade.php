@extends('layouts.admin')

@section('title', 'Edit Service Type')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Edit Service Type</h2>
                <a href="{{ route('admin.service-types.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.service-types.update', $serviceType) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Service Type Name *</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $serviceType->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="e.g., Buy"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" 
                           name="slug" 
                           id="slug" 
                           value="{{ old('slug', $serviceType->slug) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('slug') border-red-500 @enderror"
                           placeholder="buy">
                    <p class="mt-1 text-sm text-gray-500">URL-friendly version of the name</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" 
                          id="description" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Brief description of this service type...">{{ old('description', $serviceType->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                <input type="number" 
                       name="sort_order" 
                       id="sort_order" 
                       value="{{ old('sort_order', $serviceType->sort_order) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('sort_order') border-red-500 @enderror">
                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Property Types Mapping -->
            <div class="pt-6 border-t border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Map Property Types
                </label>
                <p class="text-sm text-gray-600 mb-4">Select which property types are available for this service type</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @forelse($propertyTypes as $propertyType)
                        <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-zendo-gold cursor-pointer transition-colors">
                            <input type="checkbox" name="property_types[]" value="{{ $propertyType->id }}"
                                {{ in_array($propertyType->id, old('property_types', $serviceType->propertyTypes->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold mr-3">
                            <span class="text-sm font-medium text-gray-700">
                                {{ $propertyType->name }}
                            </span>
                        </label>
                    @empty
                        <p class="text-sm text-gray-500 col-span-3">No property types available. Create property types first.</p>
                    @endforelse
                </div>
                @error('property_types')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="pt-6 border-t border-gray-200">
                <div class="flex items-center">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" 
                           name="status" 
                           id="status" 
                           value="1"
                           {{ old('status', $serviceType->status) ? 'checked' : '' }}
                           class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                    <label for="status" class="ml-2 block text-sm text-gray-700">
                        Active (visible on website)
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.service-types.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Service Type
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
