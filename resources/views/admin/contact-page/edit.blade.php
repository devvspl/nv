@extends('layouts.admin')

@section('title', 'Edit Contact Page')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Contact Page Content</h2>
                <a href="{{ route('contact') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 text-sm text-blue-600 hover:text-blue-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    View Contact Page
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mx-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Banner Section -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Banner Section</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Banner Heading</label>
                        <input type="text" name="banner_heading"
                            value="{{ old('banner_heading', $sections['banner']->heading ?? 'Contact Us') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Banner Image</label>
                        @if (isset($sections['banner']) && $sections['banner']->banner_image)
                            <div class="mb-2">
                                <img src="{{ $sections['banner']->banner_image_url }}" alt="Current Banner"
                                    class="h-32 w-auto object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="banner_image" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="border-b border-gray-200 pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Section</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subheading</label>
                        <input type="text" name="contact_subheading"
                            value="{{ old('contact_subheading', $sections['contact_section']->subheading ?? 'Contact Us') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                        <input type="text" name="contact_heading"
                            value="{{ old('contact_heading', $sections['contact_section']->heading ?? "We'd Love to Hear From You — Reach Out!") }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                            required>
                    </div>
                </div>
            </div>

            <!-- Inquiry Section -->
            <div class="pb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Inquiry Section</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subheading</label>
                            <input type="text" name="inquiry_subheading"
                                value="{{ old('inquiry_subheading', $sections['inquiry_section']->subheading ?? 'Get Inquiry') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                            <input type="text" name="inquiry_heading"
                                value="{{ old('inquiry_heading', $sections['inquiry_section']->heading ?? 'Your Dream Property Awaits — Inquire Today') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="inquiry_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('inquiry_description', $sections['inquiry_section']->description ?? 'Step into a world of refined elegance and timeless comfort.') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('contact') }}" target="_blank"
                   class="inline-flex items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Preview
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Contact Page
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
