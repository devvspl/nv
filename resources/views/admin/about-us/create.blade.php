@extends('layouts.admin')

@section('title', 'Create About Us Entry')
@section('page-title', 'Create About Us Entry')
@section('page-description', 'Add new about us content and mission statement')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Create New About Us Entry</h2>
                <a href="{{ route('admin.about-us.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <form action="{{ route('admin.about-us.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('title') border-red-500 @enderror"
                           placeholder="Our mission is to redefine real estate..."
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle *</label>
                    <input type="text" 
                           name="subtitle" 
                           id="subtitle" 
                           value="{{ old('subtitle') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('subtitle') border-red-500 @enderror"
                           placeholder="ZENDO is one of the world's leading property agents..."
                           required>
                    @error('subtitle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Brief description about the company..."
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mission Text -->
            <div>
                <label for="mission_text" class="block text-sm font-medium text-gray-700 mb-2">Mission Text *</label>
                <textarea name="mission_text" 
                          id="mission_text" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('mission_text') border-red-500 @enderror"
                          placeholder="Detailed mission statement..."
                          required>{{ old('mission_text') }}</textarea>
                @error('mission_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checklist Items -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Checklist Items</label>
                <div id="checklist-container" class="space-y-3">
                    @if(old('checklist_items'))
                        @foreach(old('checklist_items') as $index => $item)
                            <div class="checklist-item flex items-center space-x-3">
                                <input type="text" 
                                       name="checklist_items[]" 
                                       value="{{ $item }}"
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                       placeholder="Checklist item...">
                                <button type="button" onclick="removeChecklistItem(this)" 
                                        class="text-red-600 hover:text-red-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="checklist-item flex items-center space-x-3">
                            <input type="text" 
                                   name="checklist_items[]" 
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                   placeholder="Verified property listings">
                            <button type="button" onclick="removeChecklistItem(this)" 
                                    class="text-red-600 hover:text-red-800 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addChecklistItem()" 
                        class="mt-3 inline-flex items-center px-3 py-2 text-sm text-zendo-gold hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Checklist Item
                </button>
            </div>

            <!-- Stats -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Statistics</label>
                <div id="stats-container" class="space-y-4">
                    @if(old('stats'))
                        @foreach(old('stats') as $index => $stat)
                            <div class="stat-item grid grid-cols-1 md:grid-cols-4 gap-3 p-4 border border-gray-200 rounded-lg">
                                <input type="text" 
                                       name="stats[{{ $index }}][value]" 
                                       value="{{ $stat['value'] ?? '' }}"
                                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                       placeholder="15.4">
                                <input type="text" 
                                       name="stats[{{ $index }}][label]" 
                                       value="{{ $stat['label'] ?? '' }}"
                                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                       placeholder="Amount Transactions">
                                <input type="text" 
                                       name="stats[{{ $index }}][prefix]" 
                                       value="{{ $stat['prefix'] ?? '' }}"
                                       class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                       placeholder="Prefix (optional)">
                                <div class="flex items-center space-x-2">
                                    <input type="text" 
                                           name="stats[{{ $index }}][suffix]" 
                                           value="{{ $stat['suffix'] ?? '' }}"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                           placeholder="M">
                                    <button type="button" onclick="removeStatItem(this)" 
                                            class="text-red-600 hover:text-red-800 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="stat-item grid grid-cols-1 md:grid-cols-4 gap-3 p-4 border border-gray-200 rounded-lg">
                            <input type="text" 
                                   name="stats[0][value]" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                   placeholder="15.4">
                            <input type="text" 
                                   name="stats[0][label]" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                   placeholder="Amount Transactions">
                            <input type="text" 
                                   name="stats[0][prefix]" 
                                   class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                   placeholder="Prefix (optional)">
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="stats[0][suffix]" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                                       placeholder="M">
                                <button type="button" onclick="removeStatItem(this)" 
                                        class="text-red-600 hover:text-red-800 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addStatItem()" 
                        class="mt-3 inline-flex items-center px-3 py-2 text-sm text-zendo-gold hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Statistic
                </button>
            </div>

            <!-- Settings -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" 
                           name="sort_order" 
                           id="sort_order" 
                           value="{{ old('sort_order', 0) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('sort_order') border-red-500 @enderror">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.about-us.index') }}" 
                   class="inline-flex justify-center items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Create Entry
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let checklistIndex = {{ old('checklist_items') ? count(old('checklist_items')) : 1 }};
let statsIndex = {{ old('stats') ? count(old('stats')) : 1 }};

function addChecklistItem() {
    const container = document.getElementById('checklist-container');
    const div = document.createElement('div');
    div.className = 'checklist-item flex items-center space-x-3';
    div.innerHTML = `
        <input type="text" 
               name="checklist_items[]" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
               placeholder="Checklist item...">
        <button type="button" onclick="removeChecklistItem(this)" 
                class="text-red-600 hover:text-red-800 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(div);
    checklistIndex++;
}

function removeChecklistItem(button) {
    button.closest('.checklist-item').remove();
}

function addStatItem() {
    const container = document.getElementById('stats-container');
    const div = document.createElement('div');
    div.className = 'stat-item grid grid-cols-1 md:grid-cols-4 gap-3 p-4 border border-gray-200 rounded-lg';
    div.innerHTML = `
        <input type="text" 
               name="stats[${statsIndex}][value]" 
               class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
               placeholder="Value">
        <input type="text" 
               name="stats[${statsIndex}][label]" 
               class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
               placeholder="Label">
        <input type="text" 
               name="stats[${statsIndex}][prefix]" 
               class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
               placeholder="Prefix (optional)">
        <div class="flex items-center space-x-2">
            <input type="text" 
                   name="stats[${statsIndex}][suffix]" 
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent"
                   placeholder="Suffix">
            <button type="button" onclick="removeStatItem(this)" 
                    class="text-red-600 hover:text-red-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        </div>
    `;
    container.appendChild(div);
    statsIndex++;
}

function removeStatItem(button) {
    button.closest('.stat-item').remove();
}
</script>
@endsection