@extends('layouts.admin')

@section('title', 'Inquiry Details - ZendoIndia Admin')

@section('page-title', 'Property Inquiry Details')
@section('page-description', 'View inquiry information')

@section('content')
<div class="max-w-4xl space-y-6">
    <!-- Header Actions -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.property-inquiries.index') }}" 
           class="inline-flex items-center text-gray-600 hover:text-zendo-gold transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Inquiries
        </a>
    </div>

    <!-- Inquiry Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-zendo-gold rounded-full mr-4 flex items-center justify-center">
                    <span class="text-white text-xl font-bold">{{ $propertyInquiry->initials }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-heading font-bold text-zendo-navy mb-1">{{ $propertyInquiry->name }}</h1>
                    <p class="text-gray-600">{{ $propertyInquiry->formatted_inquiry_type }} Inquiry</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $propertyInquiry->status_badge }}">
                    {{ $propertyInquiry->formatted_status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-200">
            <div>
                <p class="text-sm text-gray-600 mb-1">Email</p>
                <a href="mailto:{{ $propertyInquiry->email }}" class="text-base font-medium text-blue-600 hover:text-blue-800">
                    {{ $propertyInquiry->email }}
                </a>
            </div>

            <div>
                <p class="text-sm text-gray-600 mb-1">Phone</p>
                <a href="tel:{{ $propertyInquiry->phone }}" class="text-base font-medium text-blue-600 hover:text-blue-800">
                    {{ $propertyInquiry->phone }}
                </a>
            </div>

            <div>
                <p class="text-sm text-gray-600 mb-1">Inquiry Type</p>
                <p class="text-base font-medium text-gray-900">{{ $propertyInquiry->formatted_inquiry_type }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-600 mb-1">Received On</p>
                <p class="text-base font-medium text-gray-900">{{ $propertyInquiry->created_at->format('M d, Y h:i A') }}</p>
            </div>

            @if($propertyInquiry->ip_address)
            <div>
                <p class="text-sm text-gray-600 mb-1">IP Address</p>
                <p class="text-base font-medium text-gray-900">{{ $propertyInquiry->ip_address }}</p>
            </div>
            @endif
        </div>

        @if($propertyInquiry->message)
        <div class="mt-6">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Message</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-900 whitespace-pre-wrap">{{ $propertyInquiry->message }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Property Information -->
    @if($propertyInquiry->property)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Property Details</h2>
        
        <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <div class="flex items-center flex-1">
                @if($propertyInquiry->property->mainImage)
                    <img src="{{ asset('storage/' . $propertyInquiry->property->mainImage->image_path) }}" 
                         alt="{{ $propertyInquiry->property->title }}" 
                         class="w-24 h-24 object-cover rounded-lg mr-4">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $propertyInquiry->property->title }}</h3>
                    <p class="text-sm text-gray-600 mb-1">{{ $propertyInquiry->property->location->name ?? '' }}, {{ $propertyInquiry->property->city->name ?? '' }}</p>
                    <p class="text-sm font-semibold text-zendo-gold">₹{{ number_format($propertyInquiry->property->price) }}</p>
                </div>
            </div>
            <a href="{{ route('admin.properties.show', $propertyInquiry->property) }}" 
               class="text-blue-600 hover:text-blue-900 transition-colors ml-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <p class="text-gray-600 text-center">The property associated with this inquiry has been deleted.</p>
    </div>
    @endif

    <!-- Update Status -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Update Status</h2>
        
        <form action="{{ route('admin.property-inquiries.update-status', $propertyInquiry) }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Inquiry Status</label>
                <select name="status" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    <option value="pending" {{ $propertyInquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="contacted" {{ $propertyInquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="interested" {{ $propertyInquiry->status == 'interested' ? 'selected' : '' }}>Interested</option>
                    <option value="not_interested" {{ $propertyInquiry->status == 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                    <option value="closed" {{ $propertyInquiry->status == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="flex items-center justify-end space-x-4">
                <button type="submit" 
                        class="px-6 py-2 bg-zendo-gold text-white rounded-lg hover:bg-zendo-navy transition-colors">
                    Update Status
                </button>
            </div>
        </form>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-heading font-semibold text-zendo-navy mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="mailto:{{ $propertyInquiry->email }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Send Email
            </a>

            <a href="tel:{{ $propertyInquiry->phone }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Call Now
            </a>

            <form action="{{ route('admin.property-inquiries.destroy', $propertyInquiry) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this inquiry? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Inquiry
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
