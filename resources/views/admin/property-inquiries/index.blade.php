@extends('layouts.admin')

@section('title', 'Property Inquiries - ZendoIndia Admin')

@section('page-title', 'Property Inquiries')
@section('page-description', 'Manage property inquiries from potential buyers')

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

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total</p>
                <p class="text-2xl font-bold text-zendo-navy">{{ $inquiries->total() }}</p>
            </div>
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Pending</p>
                <p class="text-2xl font-bold text-yellow-600">{{ App\Models\PropertyInquiry::pending()->count() }}</p>
            </div>
            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Contacted</p>
                <p class="text-2xl font-bold text-blue-600">{{ App\Models\PropertyInquiry::contacted()->count() }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Interested</p>
                <p class="text-2xl font-bold text-green-600">{{ App\Models\PropertyInquiry::interested()->count() }}</p>
            </div>
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Closed</p>
                <p class="text-2xl font-bold text-gray-600">{{ App\Models\PropertyInquiry::closed()->count() }}</p>
            </div>
            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Header Section -->
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
    <div>
        <h2 class="text-2xl font-heading text-zendo-navy font-semibold">
            All Property Inquiries
            @if(request('status') && request('status') !== 'all')
                <span class="text-lg text-gray-500">- {{ ucwords(str_replace('_', ' ', request('status'))) }}</span>
            @endif
        </h2>
        <p class="text-gray-600 mt-1">
            @php
                $filterText = '';
                if(request('status') && request('status') !== 'all') {
                    $filterText .= strtolower(str_replace('_', ' ', request('status'))) . ' ';
                }
            @endphp
            @if($filterText)
                Showing {{ $inquiries->total() }} {{ trim($filterText) }} inquiries
            @else
                Total {{ $inquiries->total() }} property inquiries
            @endif
        </p>
    </div>
    <div class="flex space-x-3">
        <form method="GET" action="{{ route('admin.property-inquiries.index') }}" class="flex space-x-3">
            <select name="status" onchange="this.form.submit()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                <option value="all" {{ request('status') == 'all' || !request('status') ? 'selected' : '' }}>All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="interested" {{ request('status') == 'interested' ? 'selected' : '' }}>Interested</option>
                <option value="not_interested" {{ request('status') == 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            @if(request('status') && request('status') !== 'all')
                <a href="{{ route('admin.property-inquiries.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Clear Filters
                </a>
            @endif
        </form>
    </div>
</div>

<!-- Property Inquiries Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Desktop Table View -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($inquiries as $inquiry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-zendo-gold rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-semibold text-sm">{{ $inquiry->initials }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $inquiry->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $inquiry->phone }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($inquiry->property)
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($inquiry->property->title, 40) }}</div>
                                <div class="text-sm text-gray-500">{{ $inquiry->property->location->name ?? '' }}@if($inquiry->property->location && $inquiry->property->city), @endif{{ $inquiry->property->city->name ?? '' }}</div>
                            @else
                                <span class="text-sm text-gray-500 italic">Property deleted</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                {{ $inquiry->formatted_inquiry_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs">
                                {{ Str::limit($inquiry->message ?? 'No message', 50) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $inquiry->status_badge }}">
                                {{ $inquiry->formatted_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $inquiry->created_at->format('M d, Y') }}
                            <br>
                            <span class="text-xs text-gray-400">{{ $inquiry->created_at->format('h:i A') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.property-inquiries.show', $inquiry) }}" 
                                   class="text-blue-600 hover:text-blue-900 p-1 rounded">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                
                                <!-- Status Update Dropdown -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-zendo-gold hover:text-zendo-navy p-1 rounded">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                        <div class="py-1">
                                            @foreach(['pending', 'contacted', 'interested', 'not_interested', 'closed'] as $status)
                                                <form action="{{ route('admin.property-inquiries.update-status', $inquiry) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="{{ $status }}">
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $inquiry->status === $status ? 'bg-gray-100 font-medium' : '' }}">
                                                        {{ ucwords(str_replace('_', ' ', $status)) }}
                                                    </button>
                                                </form>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                
                                <form action="{{ route('admin.property-inquiries.destroy', $inquiry) }}" method="POST" class="inline-block" 
                                      onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 p-1 rounded">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No inquiries found</h3>
                                <p class="mt-1 text-sm text-gray-500">Property inquiries will appear here when customers submit forms.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <!-- Mobile Card View -->
    <div class="lg:hidden">
        @forelse($inquiries as $inquiry)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50">
                <!-- Header with Name and Status -->
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center flex-1 mr-3">
                        <div class="w-10 h-10 bg-zendo-gold rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-semibold text-sm">{{ $inquiry->initials }}</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-900 mb-1">{{ $inquiry->name }}</h3>
                            <p class="text-xs text-gray-600">{{ $inquiry->email }}</p>
                            <p class="text-xs text-gray-600">{{ $inquiry->phone }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $inquiry->status_badge }}">
                        {{ $inquiry->formatted_status }}
                    </span>
                </div>

                <!-- Property and Message -->
                <div class="mb-3">
                    <div class="flex items-center justify-between mb-2">
                        @if($inquiry->property)
                            <p class="text-sm text-gray-900"><strong>Property:</strong> {{ Str::limit($inquiry->property->title, 30) }}</p>
                        @else
                            <p class="text-sm text-gray-500 italic">Property deleted</p>
                        @endif
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            {{ $inquiry->formatted_inquiry_type }}
                        </span>
                    </div>
                    @if($inquiry->property)
                        <p class="text-sm text-gray-600 mb-1">📍 {{ $inquiry->property->location->name ?? '' }}@if($inquiry->property->location && $inquiry->property->city), @endif{{ $inquiry->property->city->name ?? '' }}</p>
                    @endif
                    @if($inquiry->message)
                        <p class="text-sm text-gray-600">{{ Str::limit($inquiry->message, 100) }}</p>
                    @endif
                </div>

                <!-- Meta Info -->
                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                    <span>{{ $inquiry->created_at->format('M d, Y h:i A') }}</span>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.property-inquiries.show', $inquiry) }}" 
                       class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-xs font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </a>
                    
                    @canDo('property-inquiries.delete')
                    <form action="{{ route('admin.property-inquiries.destroy', $inquiry) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No inquiries found</h3>
                    <p class="mt-1 text-sm text-gray-500">Property inquiries will appear here when customers submit forms.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
@if($inquiries->hasPages())
    <div class="mt-6">
        {{ $inquiries->links() }}
    </div>
@endif
@endsection
