@extends('layouts.admin')

@section('title', 'Testimonial Details - ZendoIndia Admin')

@section('page-title', 'Testimonial Details')
@section('page-description')
View detailed information about this testimonial.
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="mb-6">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-zendo-navy">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Testimonials
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">{{ $testimonial->name }}</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<!-- Testimonial Details Card -->
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-zendo-navy to-zendo-gold p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    @if($testimonial->avatar)
                        <img class="w-20 h-20 rounded-full object-cover border-4 border-white/20" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                    @else
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center border-4 border-white/20">
                            <span class="text-white font-bold text-2xl">{{ $testimonial->initials }}</span>
                        </div>
                    @endif
                    <div class="ml-6">
                        <h2 class="text-2xl font-heading text-white font-semibold">{{ $testimonial->name }}</h2>
                        <p class="text-white/90">{{ $testimonial->position }}</p>
                        @if($testimonial->company)
                            <p class="text-white/80 text-sm">{{ $testimonial->company }}</p>
                        @endif
                        <div class="mt-2">
                            @if($testimonial->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @canDo('testimonials.edit')
<a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                       class="inline-flex items-center px-4 py-2 bg-white/20 text-white font-medium rounded-lg hover:bg-white/30 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Testimonial
                    </a>
                </div>
            </div>
        </div>

        <!-- Testimonial Content -->
        <div class="p-6">
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-zendo-gold" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    Testimonial Content
                </h3>
                <div class="bg-gray-50 rounded-lg p-6 border-l-4 border-zendo-gold">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-zendo-gold mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-700 text-lg leading-relaxed italic">"{{ $testimonial->content }}"</p>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Client Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Position</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->position }}</p>
                        </div>
                        @if($testimonial->company)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Company</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->company }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <div class="mt-1">
                                @if($testimonial->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">System Information</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Testimonial ID</label>
                            <p class="mt-1 text-sm text-gray-900">#{{ $testimonial->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Display Order</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->sort_order }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Created</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->created_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Last Updated</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $testimonial->updated_at->format('F d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-gray-50 px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Testimonials
                </a>
                
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-medium rounded-lg hover:bg-zendo-navy transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Testimonial
                    </a>
@endCanDo
                    
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this testimonial? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Testimonial
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection