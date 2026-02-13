@extends('layouts.admin')

@section('title', 'View Property Type')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Property Type Details</h2>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.property-types.edit', $propertyType) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm bg-zendo-gold text-white rounded-lg hover:bg-opacity-90 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.property-types.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Property Type Header -->
            <div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-20 h-20 bg-zendo-gold rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">{{ substr($propertyType->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-2xl font-heading font-bold text-zendo-navy">{{ $propertyType->name }}</h3>
                            @if($propertyType->category)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $propertyType->category === 'residential' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }} mt-2">
                                    {{ ucfirst($propertyType->category) }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $propertyType->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                @if($propertyType->status)
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                @else
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                            {{ $propertyType->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Basic Information -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Property Type Name</p>
                        <p class="text-base font-medium text-gray-900">{{ $propertyType->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Category</p>
                        @if($propertyType->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $propertyType->category === 'residential' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                {{ ucfirst($propertyType->category) }}
                            </span>
                        @else
                            <p class="text-base font-medium text-gray-400">Not specified</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Sort Order</p>
                        <p class="text-base font-medium text-gray-900">{{ $propertyType->sort_order }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Service Types Mapped</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $propertyType->serviceTypes->count() }} mapped
                        </span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($propertyType->description)
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Description</h3>
                <p class="text-gray-700 leading-relaxed">{{ $propertyType->description }}</p>
            </div>
            @endif

            <!-- Mapped Service Types -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Mapped Service Types</h3>
                @if($propertyType->serviceTypes->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($propertyType->serviceTypes as $serviceType)
                            <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <span class="text-sm font-medium text-gray-700">
                                    {{ $serviceType->name }}
                                </span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $serviceType->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $serviceType->status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">No service types mapped yet</p>
                @endif
            </div>

            <!-- Account Information -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Record Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Created</p>
                        <p class="text-base font-medium text-gray-900">{{ $propertyType->created_at->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Last Updated</p>
                        <p class="text-base font-medium text-gray-900">{{ $propertyType->updated_at->format('F d, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="flex flex-wrap gap-3">
                    <form action="{{ route('admin.property-types.destroy', $propertyType) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this property type? This will also remove all service type mappings.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Property Type
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
