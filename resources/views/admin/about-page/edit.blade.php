@extends('layouts.admin')

@section('title', 'Edit About Page')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Edit About Page Content</h2>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.about-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Our Company Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-heading text-zendo-navy font-semibold mb-6 pb-3 border-b border-gray-200">
                    Our Company Section
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Section Title -->
                    <div>
                        <label for="section_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Title
                        </label>
                        <input type="text" name="section_title" id="section_title"
                            value="{{ old('section_title', $aboutPage->section_title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        @error('section_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Section Subtitle -->
                    <div>
                        <label for="section_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Subtitle/Heading
                        </label>
                        <input type="text" name="section_subtitle" id="section_subtitle"
                            value="{{ old('section_subtitle', $aboutPage->section_subtitle) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        @error('section_subtitle')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Who We Are -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Who We Are</h4>
                        </div>
                        <div>
                            <label for="who_we_are_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" name="who_we_are_title" id="who_we_are_title"
                                value="{{ old('who_we_are_title', $aboutPage->who_we_are_title) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>
                        <div>
                            <label for="who_we_are_icon" class="block text-sm font-medium text-gray-700 mb-2">
                                Icon
                            </label>
                            <input type="file" name="who_we_are_icon" id="who_we_are_icon" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @if($aboutPage->who_we_are_icon_url)
                                <img src="{{ $aboutPage->who_we_are_icon_url }}" alt="Current Icon" class="mt-2 h-16 w-16 object-contain">
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <label for="who_we_are_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="who_we_are_description" id="who_we_are_description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('who_we_are_description', $aboutPage->who_we_are_description) }}</textarea>
                        </div>
                    </div>

                    <!-- Mission -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Mission</h4>
                        </div>
                        <div>
                            <label for="mission_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" name="mission_title" id="mission_title"
                                value="{{ old('mission_title', $aboutPage->mission_title) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>
                        <div>
                            <label for="mission_icon" class="block text-sm font-medium text-gray-700 mb-2">
                                Icon
                            </label>
                            <input type="file" name="mission_icon" id="mission_icon" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @if($aboutPage->mission_icon_url)
                                <img src="{{ $aboutPage->mission_icon_url }}" alt="Current Icon" class="mt-2 h-16 w-16 object-contain">
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <label for="mission_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="mission_description" id="mission_description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('mission_description', $aboutPage->mission_description) }}</textarea>
                        </div>
                    </div>

                    <!-- Vision -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Vision</h4>
                        </div>
                        <div>
                            <label for="vision_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" name="vision_title" id="vision_title"
                                value="{{ old('vision_title', $aboutPage->vision_title) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>
                        <div>
                            <label for="vision_icon" class="block text-sm font-medium text-gray-700 mb-2">
                                Icon
                            </label>
                            <input type="file" name="vision_icon" id="vision_icon" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @if($aboutPage->vision_icon_url)
                                <img src="{{ $aboutPage->vision_icon_url }}" alt="Current Icon" class="mt-2 h-16 w-16 object-contain">
                            @endif
                        </div>
                        <div class="md:col-span-2">
                            <label for="vision_description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea name="vision_description" id="vision_description" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('vision_description', $aboutPage->vision_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Values Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-heading text-zendo-navy font-semibold mb-6 pb-3 border-b border-gray-200">
                    Our Values Section
                </h3>

                <div class="grid grid-cols-1 gap-6">
                    <!-- Values Heading -->
                    <div>
                        <label for="values_heading" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Heading
                        </label>
                        <input type="text" name="values_heading" id="values_heading"
                            value="{{ old('values_heading', $aboutPage->values_heading) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    </div>

                    <!-- Values Content -->
                    <div>
                        <label for="values_who_we_are" class="block text-sm font-medium text-gray-700 mb-2">
                            Who We Are Content
                        </label>
                        <textarea name="values_who_we_are" id="values_who_we_are" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('values_who_we_are', $aboutPage->values_who_we_are) }}</textarea>
                    </div>

                    <div>
                        <label for="values_mission" class="block text-sm font-medium text-gray-700 mb-2">
                            Our Mission Content
                        </label>
                        <textarea name="values_mission" id="values_mission" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('values_mission', $aboutPage->values_mission) }}</textarea>
                    </div>

                    <div>
                        <label for="values_vision" class="block text-sm font-medium text-gray-700 mb-2">
                            Our Vision Content
                        </label>
                        <textarea name="values_vision" id="values_vision" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('values_vision', $aboutPage->values_vision) }}</textarea>
                    </div>

                    <div>
                        <label for="values_teamwork" class="block text-sm font-medium text-gray-700 mb-2">
                            Teamwork Content
                        </label>
                        <textarea name="values_teamwork" id="values_teamwork" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('values_teamwork', $aboutPage->values_teamwork) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-heading text-zendo-navy font-semibold mb-6 pb-3 border-b border-gray-200">
                    Team Section
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="team_section_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Title
                        </label>
                        <input type="text" name="team_section_title" id="team_section_title"
                            value="{{ old('team_section_title', $aboutPage->team_section_title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    </div>

                    <div>
                        <label for="team_section_heading" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Heading
                        </label>
                        <input type="text" name="team_section_heading" id="team_section_heading"
                            value="{{ old('team_section_heading', $aboutPage->team_section_heading) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                        {{ old('is_active', $aboutPage->is_active) ? 'checked' : '' }}
                        class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Active
                    </label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-3">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update About Page
                </button>
            </div>
        </form>
    </div>
@endsection
