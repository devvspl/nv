@extends('layouts.admin')

@section('title', 'View Service Type')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Service Type Details</h2>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.service-types.edit', $serviceType) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Service Type
                    </a>
                    <a href="{{ route('admin.service-types.index') }}" 
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
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $serviceType->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $serviceType->status ? 'Active' : 'Inactive' }}
                    </span>
                    <span class="text-sm text-gray-600">Sort Order: {{ $serviceType->sort_order }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    <p>Created: {{ $serviceType->created_at->format('M d, Y \a\t g:i A') }}</p>
                    <p>Updated: {{ $serviceType->updated_at->format('M d, Y \a\t g:i A') }}</p>
                </div>
            </div>

            <!-- Service Type Information -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Service Type Name</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg text-xl font-medium">
                            @if($serviceType->icon)
                                <span class="text-3xl mr-2">{{ $serviceType->icon }}</span>
                            @endif
                            {{ $serviceType->name }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Slug</h3>
                        <p class="text-gray-700 bg-gray-50 p-4 rounded-lg font-mono">{{ $serviceType->slug }}</p>
                    </div>

                    @if($serviceType->icon)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Icon</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="text-5xl">{{ $serviceType->icon }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            @if($serviceType->description)
                                <p class="text-gray-700 leading-relaxed">{{ $serviceType->description }}</p>
                            @else
                                <p class="text-gray-500 italic">No description provided</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Mapped Property Types</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-2xl font-bold text-zendo-gold">{{ $serviceType->propertyTypes->count() }}</span>
                                <span class="text-sm text-gray-600">Property Types Mapped</span>
                            </div>
                            @if($serviceType->propertyTypes->count() > 0)
                                <div class="space-y-2">
                                    @foreach($serviceType->propertyTypes as $propertyType)
                                        <div class="flex items-center justify-between p-2 bg-white border border-gray-200 rounded">
                                            <span class="text-sm font-medium text-gray-700">
                                                @if($propertyType->icon){{ $propertyType->icon }} @endif
                                                {{ $propertyType->name }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $propertyType->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $propertyType->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic">No property types mapped yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <form action="{{ route('admin.service-types.toggle-status', $serviceType) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 {{ $serviceType->status ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-semibold rounded-lg transition-colors">
                            {{ $serviceType->status ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.service-types.edit', $serviceType) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Service Type
                    </a>
                    <form action="{{ route('admin.service-types.destroy', $serviceType) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this service type? This will also remove all property type mappings.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Service Type
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
