@extends('layouts.admin')

@section('title', 'Property Inquiries - ZendoIndia Admin')

@section('page-title', 'Property Inquiries')
@section('page-description', 'Manage property inquiries from potential buyers')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Property Inquiries</h2>
            <p class="text-gray-600 mt-1">Total {{ $inquiries->total() }} inquiries received</p>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Desktop Table View -->
    <div class="hidden md:block bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-zendo-gold rounded-full mr-3 flex items-center justify-center">
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
                                    <div class="text-sm text-gray-500">{{ $inquiry->property->location->name ?? '' }}, {{ $inquiry->property->city->name ?? '' }}</div>
                                @else
                                    <span class="text-sm text-gray-500">Property deleted</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $inquiry->formatted_inquiry_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('admin.property-inquiries.update-status', $inquiry) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" 
                                            class="text-xs font-medium rounded-full px-2.5 py-0.5 border-0 {{ $inquiry->status_badge }} cursor-pointer">
                                        <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="interested" {{ $inquiry->status == 'interested' ? 'selected' : '' }}>Interested</option>
                                        <option value="not_interested" {{ $inquiry->status == 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                                        <option value="closed" {{ $inquiry->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $inquiry->created_at->format('M d, Y') }}
                                <div class="text-xs text-gray-500">{{ $inquiry->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.property-inquiries.show', $inquiry) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors" title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.property-inquiries.destroy', $inquiry) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Delete">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                                </svg>
                                <p class="text-lg font-medium">No inquiries found</p>
                                <p class="mt-1">Property inquiries will appear here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($inquiries as $inquiry)
            <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                <div class="flex items-start mb-4">
                    <div class="w-12 h-12 bg-zendo-gold rounded-full mr-4 flex items-center justify-center">
                        <span class="text-white font-bold">{{ $inquiry->initials }}</span>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $inquiry->name }}</h3>
                        <p class="text-sm text-gray-600 mb-1">{{ $inquiry->email }}</p>
                        <p class="text-sm text-gray-600 mb-2">{{ $inquiry->phone }}</p>
                        @if($inquiry->property)
                            <p class="text-sm text-gray-700 font-medium">{{ Str::limit($inquiry->property->title, 40) }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center space-x-2 mb-3">
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                        {{ $inquiry->formatted_inquiry_type }}
                    </span>
                    <form action="{{ route('admin.property-inquiries.update-status', $inquiry) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" 
                                class="text-xs font-medium rounded px-2 py-0.5 {{ $inquiry->status_badge }} cursor-pointer">
                            <option value="pending" {{ $inquiry->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="contacted" {{ $inquiry->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="interested" {{ $inquiry->status == 'interested' ? 'selected' : '' }}>Interested</option>
                            <option value="not_interested" {{ $inquiry->status == 'not_interested' ? 'selected' : '' }}>Not Interested</option>
                            <option value="closed" {{ $inquiry->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </form>
                </div>

                <p class="text-sm text-gray-600 mb-4">{{ $inquiry->created_at->format('M d, Y h:i A') }}</p>
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.property-inquiries.show', $inquiry) }}" 
                       class="inline-flex items-center px-3 py-1.5 text-sm text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </a>
                    <form action="{{ route('admin.property-inquiries.destroy', $inquiry) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 hover:text-red-800 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                </svg>
                <p class="text-lg font-medium text-gray-900">No inquiries found</p>
                <p class="mt-1 text-gray-600">Property inquiries will appear here.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($inquiries->hasPages())
        <div class="flex justify-center">
            {{ $inquiries->links() }}
        </div>
    @endif
</div>
@endsection
