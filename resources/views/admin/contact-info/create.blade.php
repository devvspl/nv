@extends('layouts.admin')

@section('title', 'Add Contact Information')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Add Contact Information</h2>
            <p class="text-gray-600 mt-1">Create a new contact information card</p>
        </div>

        <form action="{{ route('admin.contact-info.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg shadow-lg p-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section Key <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="section_key" value="{{ old('section_key') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                        required>
                    <p class="text-sm text-gray-500 mt-1">Unique identifier (e.g., office_address, contact_no)</p>
                    @error('section_key')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                        required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content <span
                            class="text-red-500">*</span></label>
                    <textarea name="content" rows="4"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                        required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                    <input type="file" name="icon" accept="image/*"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold">
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                        required>
                    @error('sort_order')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                        class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active</label>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('admin.contact-info.index') }}"
                    class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all duration-200">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Create Contact Info
                </button>
            </div>
        </form>
    </div>
@endsection
