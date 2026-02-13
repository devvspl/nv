@extends('layouts.admin')

@section('title', 'Edit Amenity - ZendoIndia Admin')

@section('page-title', 'Edit Amenity')
@section('page-description', 'Update amenity information')

@section('content')
<div class="max-w-3xl">
    <form action="{{ route('admin.amenities.update', $amenity) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-heading font-semibold text-zendo-navy mb-4">Amenity Information</h3>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amenity Name *</label>
                    <input type="text" name="name" value="{{ old('name', $amenity->name) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                           placeholder="e.g., Swimming Pool, Gym, Security">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                    <select name="category" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        <option value="">Select Category</option>
                        <option value="basic" {{ old('category', $amenity->category) == 'basic' ? 'selected' : '' }}>Basic</option>
                        <option value="security" {{ old('category', $amenity->category) == 'security' ? 'selected' : '' }}>Security</option>
                        <option value="recreation" {{ old('category', $amenity->category) == 'recreation' ? 'selected' : '' }}>Recreation</option>
                        <option value="convenience" {{ old('category', $amenity->category) == 'convenience' ? 'selected' : '' }}>Convenience</option>
                        <option value="eco_friendly" {{ old('category', $amenity->category) == 'eco_friendly' ? 'selected' : '' }}>Eco Friendly</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $amenity->display_order) }}" min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                           placeholder="0">
                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                    @error('display_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ old('status', $amenity->status) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                        <span class="text-sm font-medium text-gray-700">Active</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-500">Only active amenities will be available for properties</p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.amenities.index') }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-zendo-gold text-white rounded-lg hover:bg-zendo-navy transition-colors">
                Update Amenity
            </button>
        </div>
    </form>
</div>
@endsection
