@extends('layouts.admin')

@section('title', 'Testimonials Management - ZendoIndia Admin')

@section('page-title', 'Testimonials Management')
@section('page-description')
Manage customer testimonials that appear on the website.
@endsection

@section('content')
<!-- Success/Error Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<!-- Header Section -->
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
    <div>
        <h2 class="text-2xl font-heading text-zendo-navy font-semibold">All Testimonials</h2>
        <p class="text-gray-600 mt-1">Total {{ $testimonials->total() }} testimonials</p>
    </div>
    @canDo('testimonials.create')
    <a href="{{ route('admin.testimonials.create') }}" 
       class="inline-flex items-center px-4 py-2 bg-zendo-gold text-white font-medium rounded-lg hover:bg-zendo-navy transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Add New Testimonial
    </a>
    @endCanDo
</div>

<!-- Testimonials Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Desktop Table View -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($testimonials as $testimonial)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($testimonial->avatar)
                                    <img class="w-10 h-10 rounded-full object-cover" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                                @else
                                    <div class="w-10 h-10 bg-zendo-gold rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ $testimonial->initials }}</span>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $testimonial->position }}</div>
                            @if($testimonial->company)
                                <div class="text-sm text-gray-500">{{ $testimonial->company }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate">
                                "{{ Str::limit($testimonial->content, 50) }}"
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($testimonial->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $testimonial->sort_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.testimonials.show', $testimonial) }}" 
                                   class="text-blue-600 hover:text-blue-900 p-1 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                @canDo('testimonials.edit')
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                                   class="text-zendo-gold hover:text-zendo-navy p-1 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                @endCanDo
                                @canDo('testimonials.delete')
                                <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-{{ $testimonial->is_active ? 'red' : 'green' }}-600 hover:text-{{ $testimonial->is_active ? 'red' : 'green' }}-900 p-1 rounded">
                                        @if($testimonial->is_active)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline-block" 
                                      onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-1 rounded">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endCanDo
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No testimonials found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new testimonial.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="lg:hidden">
        @forelse($testimonials as $testimonial)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50">
                <!-- Header with Avatar and Name -->
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        @if($testimonial->avatar)
                            <img class="w-12 h-12 rounded-full object-cover" src="{{ Storage::url($testimonial->avatar) }}" alt="{{ $testimonial->name }}">
                        @else
                            <div class="w-12 h-12 bg-zendo-gold rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ $testimonial->initials }}</span>
                            </div>
                        @endif
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $testimonial->position }}</p>
                            @if($testimonial->company)
                                <p class="text-xs text-gray-400">{{ $testimonial->company }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-1">
                        @if($testimonial->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <p class="text-sm text-gray-700 italic">
                        "{{ Str::limit($testimonial->content, 120) }}"
                    </p>
                </div>

                <!-- Meta Info -->
                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                    <span>Order: {{ $testimonial->sort_order }}</span>
                    <span>{{ $testimonial->created_at->format('M d, Y') }}</span>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.testimonials.show', $testimonial) }}" 
                       class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </a>
                    @canDo('testimonials.edit')
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" 
                       class="inline-flex items-center px-3 py-1 border border-zendo-gold rounded-md text-xs font-medium text-zendo-gold bg-white hover:bg-zendo-light-bg">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    @endCanDo
                    @canDo('testimonials.delete')
                    <form action="{{ route('admin.testimonials.toggle-status', $testimonial) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-{{ $testimonial->is_active ? 'red' : 'green' }}-300 rounded-md text-xs font-medium text-{{ $testimonial->is_active ? 'red' : 'green' }}-700 bg-white hover:bg-{{ $testimonial->is_active ? 'red' : 'green' }}-50">
                            @if($testimonial->is_active)
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                </svg>
                                Deactivate
                            @else
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Activate
                            @endif
                        </button>
                    </form>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-xs font-medium text-red-700 bg-white hover:bg-red-50">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                    @endCanDo
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No testimonials found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new testimonial.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
@if($testimonials->hasPages())
    <div class="mt-6">
        {{ $testimonials->links() }}
    </div>
@endif
@endsection
