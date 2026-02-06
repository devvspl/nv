@extends('layouts.admin')

@section('title', 'View Category')
@section('page-title', 'Category Details')
@section('page-description', 'View category information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Category Details</h2>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.categories.edit', $category) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Category
                    </a>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-8">
            <!-- Status and Meta Info -->
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $category->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $category->status ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="text-sm text-gray-600">Sort Order: {{ $category->sort_order }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    <p>Created: {{ $category->created_at->format('M d, Y \a\t g:i A') }}</p>
                    <p>Updated: {{ $category->updated_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>

            <!-- Category Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Category Name</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg text-xl font-medium">{{ $category->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Slug</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg font-mono">{{ $category->slug }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Link URL</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                            @if($category->link && $category->link !== '#')
                                <a href="{{ $category->link }}" target="_blank" class="text-zendo-gold hover:text-zendo-navy transition-colors">
                                    {{ $category->link }}
                                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="text-gray-500 italic">No link specified</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Icon</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            @if($category->icon)
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $category->icon_url }}" alt="{{ $category->name }} Icon" class="w-16 h-16 border border-gray-200 rounded-lg p-2">
                                    <div>
                                        <p class="text-gray-700 font-medium">{{ $category->icon }}</p>
                                        <p class="text-sm text-gray-500">{{ $category->icon_url }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 italic">No icon specified</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 leading-relaxed">{{ $category->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Website Preview</h3>
                <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300">
                    <div class="max-w-sm mx-auto">
                        <!-- Preview Card -->
                        <a href="{{ $category->link }}" 
                           class="category-card flex flex-col items-center p-8 rounded-lg shadow-lg transition-all duration-300 bg-gradient-to-br from-zendo-navy to-gray-900 text-white hover:shadow-xl">
                            @if($category->icon)
                                <img src="{{ $category->icon_url }}" alt="{{ $category->name }} Icon" 
                                     class="w-16 h-16 mb-4 text-zendo-gold transition-colors duration-300">
                            @else
                                <div class="w-16 h-16 mb-4 bg-zendo-gold rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">{{ substr($category->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <h3 class="text-xl font-medium font-heading text-white mb-2 text-center">{{ strtoupper($category->name) }}</h3>
                            <p class="text-gray-300 font-body text-lg leading-relaxed text-center">{{ $category->description }}</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 {{ $category->status ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-semibold rounded-lg transition-colors">
                            {{ $category->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.categories.edit', $category) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Category
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection