@extends('layouts.admin')
@section('title', 'Create FAQ')
@section('page-title', 'Create FAQ')
@section('page-description', 'Add new frequently asked question')
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-heading text-zendo-navy font-semibold">Create New FAQ</h2>
                    <a href="{{ route('admin.faqs.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                <!-- Question -->
                <div>
                    <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Question *</label>
                    <input type="text" name="question" id="question" value="{{ old('question') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('question') border-red-500 @enderror"
                        placeholder="Enter the FAQ question" required>
                    @error('question')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Answer -->
                <div>
                    <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Answer *</label>
                    <textarea name="answer" id="answer" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('answer') border-red-500 @enderror"
                        placeholder="Enter the detailed answer" required>{{ old('answer') }}</textarea>
                    @error('answer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Settings -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('sort_order') border-red-500 @enderror">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="h-4 w-4 text-zendo-gold focus:ring-zendo-gold border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Active (visible on website)
                        </label>
                    </div>
                </div>
                <!-- Submit Buttons -->
                <div
                    class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.faqs.index') }}"
                        class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Create FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
