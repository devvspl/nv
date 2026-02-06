@extends('layouts.admin')

@section('title', 'View About Us Entry')
@section('page-title', 'About Us Entry Details')
@section('page-description', 'View about us content and mission statement details')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">About Us Entry Details</h2>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.about-us.edit', $aboutUs) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Entry
                    </a>
                    <a href="{{ route('admin.about-us.index') }}" 
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
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $aboutUs->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $aboutUs->status ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="text-sm text-gray-600">Sort Order: {{ $aboutUs->sort_order }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    <p>Created: {{ $aboutUs->created_at->format('M d, Y \a\t g:i A') }}</p>
                    <p>Updated: {{ $aboutUs->updated_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Title</h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $aboutUs->title }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Subtitle</h3>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $aboutUs->subtitle }}</p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $aboutUs->description }}</p>
                </div>
            </div>

            <!-- Mission Text -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Mission Text</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $aboutUs->mission_text }}</p>
                </div>
            </div>

            <!-- Checklist Items -->
            @if($aboutUs->checklist_items && count($aboutUs->checklist_items) > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Checklist Items</h3>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <ul class="space-y-3">
                            @foreach($aboutUs->checklist_items as $item)
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 w-5 h-5 text-zendo-gold mr-3 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-gray-700">{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Statistics -->
            @if($aboutUs->stats && count($aboutUs->stats) > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($aboutUs->stats as $stat)
                            <div class="bg-gray-50 p-6 rounded-lg text-center">
                                <p class="text-3xl lg:text-4xl font-medium font-heading text-zendo-gold mb-2">
                                    {{ $stat['prefix'] ?? '' }}{{ $stat['value'] ?? '' }}{{ $stat['suffix'] ?? '' }}
                                </p>
                                <p class="text-sm font-semibold uppercase tracking-wider text-gray-600">
                                    {{ $stat['label'] ?? '' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Preview Section -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Website Preview</h3>
                <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300">
                    <div class="max-w-4xl mx-auto">
                        <!-- Preview Content -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                            <!-- Left Content -->
                            <div class="lg:col-span-2">
                                <span class="inline-block px-3 py-1 bg-zendo-gold bg-opacity-10 text-zendo-gold text-sm font-semibold rounded-full mb-4">About Us</span>
                                <h2 class="text-2xl lg:text-3xl font-heading text-zendo-navy mb-4">
                                    {{ $aboutUs->title }}
                                </h2>
                                <p class="text-lg font-medium text-gray-700 mb-4">
                                    {{ $aboutUs->subtitle }}
                                </p>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ Str::limit($aboutUs->mission_text, 200) }}
                                </p>
                            </div>

                            <!-- Right Checklist -->
                            @if($aboutUs->checklist_items && count($aboutUs->checklist_items) > 0)
                                <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100">
                                    <ul class="space-y-4">
                                        @foreach(array_slice($aboutUs->checklist_items, 0, 5) as $item)
                                            <li class="flex items-start">
                                                <svg class="flex-shrink-0 w-5 h-5 text-zendo-gold mr-3 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-700 text-sm">{{ $item }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- Stats Preview -->
                        @if($aboutUs->stats && count($aboutUs->stats) > 0)
                            <div class="mt-12 pt-8 border-t border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-{{ min(count($aboutUs->stats), 3) }} gap-8 text-center">
                                    @foreach(array_slice($aboutUs->stats, 0, 3) as $stat)
                                        <div>
                                            <p class="text-3xl lg:text-4xl font-medium font-heading text-zendo-gold">
                                                {{ $stat['prefix'] ?? '' }}{{ $stat['value'] ?? '' }}{{ $stat['suffix'] ?? '' }}
                                            </p>
                                            <p class="mt-2 text-xs font-semibold uppercase tracking-wider text-gray-600">
                                                {{ $stat['label'] ?? '' }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <form action="{{ route('admin.about-us.toggle-status', $aboutUs) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 {{ $aboutUs->status ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-semibold rounded-lg transition-colors">
                            {{ $aboutUs->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.about-us.edit', $aboutUs) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Entry
                    </a>
                    <form action="{{ route('admin.about-us.destroy', $aboutUs) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this about us entry? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Entry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection