@extends('layouts.admin')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-heading text-zendo-navy font-semibold">City Details</h1>
            <p class="text-gray-600 mt-1">View city information</p>
        </div>
        <div class="flex space-x-3">
            @canDo('cities.edit')
<a href="{{ route('admin.cities.edit', $city) }}" 
               class="bg-zendo-gold hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit City
            </a>
            <a href="{{ route('admin.cities.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Cities
            </a>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Column - Image -->
        <div class="relative">
            <img src="{{ $city->image_url }}" alt="{{ $city->name }}" 
                 class="w-full h-96 lg:h-full object-cover">
            <div class="absolute top-4 right-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $city->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $city->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="p-8">
            <div class="space-y-6">
                <!-- Name -->
                <div>
                    <h2 class="text-3xl font-heading text-zendo-navy font-semibold mb-2">{{ $city->name }}</h2>
                    <p class="text-gray-500 text-sm">Slug: {{ $city->slug }}</p>
                </div>

                <!-- Description -->
                @if($city->description)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $city->description }}</p>
                </div>
                @endif

                <!-- Property Count -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Properties Available</h3>
                    <p class="text-2xl font-semibold text-zendo-gold">{{ $city->formatted_property_count }}</p>
                </div>

                <!-- Link -->
                @if($city->link && $city->link !== '#')
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Link</h3>
                    <a href="{{ $city->link }}" target="_blank" 
                       class="text-zendo-gold hover:text-yellow-600 underline break-all">
                        {{ $city->link }}
                    </a>
@endCanDo
                </div>
                @endif

                <!-- Sort Order -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Sort Order</h3>
                    <p class="text-gray-600">{{ $city->sort_order }}</p>
                </div>

                <!-- Timestamps -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-500">
                        <div>
                            <span class="font-medium">Created:</span><br>
                            {{ $city->created_at->format('M d, Y \a\t g:i A') }}
                        </div>
                        <div>
                            <span class="font-medium">Updated:</span><br>
                            {{ $city->updated_at->format('M d, Y \a\t g:i A') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Actions -->
<div class="mt-6 flex justify-end space-x-4">
    <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" 
                onclick="return confirm('Are you sure you want to delete this city? This action cannot be undone.')"
                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
            Delete City
        </button>
    </form>
</div>

@endsection