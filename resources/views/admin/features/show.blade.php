@extends('layouts.admin')

@section('title', 'View Feature - ZendoIndia Admin')

@section('page-title', 'Feature Details')
@section('page-description')
View the complete feature information.
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.features.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Features
        </a>
    </div>

    <!-- Feature Details Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Feature Information</h3>
                <p class="mt-1 text-sm text-gray-600">Complete details of the feature.</p>
            </div>
            <div class="flex items-center space-x-3">
                @if($feature->is_active)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        Inactive
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-900 font-medium">{{ $feature->title }}</p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $feature->description }}</p>
                </div>
            </div>

            <!-- Icon -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($feature->icon)
                        <div class="flex items-center space-x-4">
                            <img src="{{ $feature->icon_url }}" alt="Feature Icon" class="w-16 h-16 border border-gray-200 rounded-lg p-2">
                            <div>
                                <p class="text-gray-900 font-medium">{{ basename($feature->icon) }}</p>
                                <p class="text-sm text-gray-500">{{ $feature->icon }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500 italic">No icon assigned</p>
                    @endif
                </div>
            </div>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 font-medium">{{ $feature->sort_order }}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Created</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 text-sm">{{ $feature->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Updated</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 text-sm">{{ $feature->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Preview -->
            @if($feature->is_active)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-start">
                            @if($feature->icon)
                                <div class="flex-shrink-0 w-16 h-16 bg-zendo-light-bg rounded-full flex items-center justify-center mr-5">
                                    <img src="{{ $feature->icon_url }}" alt="Feature Icon" class="w-8 h-8 text-zendo-gold">
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xl font-semibold font-heading text-zendo-navy mb-1">{{ $feature->title }}</h3>
                                <p class="text-gray-600 font-body leading-relaxed">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                @canDo('features.delete')
<form action="{{ route('admin.features.toggle-status', $feature) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="px-4 py-2 border border-{{ $feature->is_active ? 'red' : 'green' }}-300 rounded-lg text-sm font-medium text-{{ $feature->is_active ? 'red' : 'green' }}-700 bg-white hover:bg-{{ $feature->is_active ? 'red' : 'green' }}-50 transition-colors">
                        {{ $feature->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
                @canDo('features.edit')
<a href="{{ route('admin.features.edit', $feature) }}" 
                   class="px-4 py-2 bg-zendo-gold text-white rounded-lg text-sm font-medium hover:bg-zendo-navy transition-colors">
                    Edit Feature
                </a>
@endCanDo
                <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline-block" 
                      onsubmit="return confirm('Are you sure you want to delete this feature?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors">
                        Delete Feature
                    </button>
                </form>
@endCanDo
            </div>
        </div>
    </div>
</div>
@endsection