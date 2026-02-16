@extends('layouts.admin')

@section('title', 'Edit Contact Page')

@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Contact Page Content</h2>
                <p class="text-gray-600 mt-1">Manage all contact page sections</p>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.contact-page.update') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg shadow-lg p-8">
            @csrf
            @method('PUT')

            <div class="space-y-8">
                <!-- Banner Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Banner Section</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Banner Heading</label>
                            <input type="text" name="banner_heading"
                                value="{{ old('banner_heading', $sections['banner']->heading ?? 'Contact Us') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
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
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold">
                            <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Contact Section</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subheading</label>
                            <input type="text" name="contact_subheading"
                                value="{{ old('contact_subheading', $sections['contact_section']->subheading ?? 'Contact Us') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                            <input type="text" name="contact_heading"
                                value="{{ old('contact_heading', $sections['contact_section']->heading ?? "We'd Love to Hear From You — Reach Out!") }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Inquiry Section -->
                <div>
                    <h3 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Inquiry Section</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subheading</label>
                            <input type="text" name="inquiry_subheading"
                                value="{{ old('inquiry_subheading', $sections['inquiry_section']->subheading ?? 'Get Inquiry') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Heading</label>
                            <input type="text" name="inquiry_heading"
                                value="{{ old('inquiry_heading', $sections['inquiry_section']->heading ?? 'Your Luxurious Escape Awaits — Reserve Today') }}"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold"
                                required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="inquiry_description" rows="3"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-zendo-gold">{{ old('inquiry_description', $sections['inquiry_section']->description ?? 'Step into a world of refined elegance and timeless comfort.') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="px-6 py-3 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Update Contact Page
                </button>
            </div>
        </form>
    </div>
@endsection
