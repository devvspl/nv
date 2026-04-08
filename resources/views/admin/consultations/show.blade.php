@extends('layouts.admin')

@section('title', 'Consultation Details - ZendoIndia Admin')
@section('page-title', 'Consultation Details')
@section('page-description', 'View and manage consultation information')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Consultation #{{ $consultation->id }}</h2>
                <a href="{{ route('admin.consultations.index') }}" 
                   class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Consultations
                </a>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-zendo-gold rounded-full flex items-center justify-center mr-4">
                                    <span class="text-white font-semibold">{{ $consultation->initials }}</span>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $consultation->name }}</h4>
                                    <p class="text-sm text-gray-600">Customer</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <a href="mailto:{{ $consultation->email }}" class="text-zendo-navy hover:text-zendo-gold">{{ $consultation->email }}</a>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <a href="tel:{{ $consultation->phone }}" class="text-zendo-navy hover:text-zendo-gold">{{ $consultation->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Information -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Property Information</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-600">Property Type</span>
                                        <p class="text-gray-900 font-medium">{{ $consultation->property_type ?? 'Not specified' }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-600">Inquiry Type</span>
                                        <p class="text-gray-900 font-medium">{{ $consultation->formatted_inquiry_type }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            @if($consultation->location || $consultation->budget_range)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200">
                                @if($consultation->location)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-600">Location</span>
                                        <p class="text-gray-900 font-medium">{{ $consultation->location }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($consultation->budget_range)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-600">Budget Range</span>
                                        <p class="text-gray-900 font-medium">{{ $consultation->budget_range }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Message -->
                    @if($consultation->message)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Message</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-700 leading-relaxed">{{ $consultation->message }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Requirements -->
                    @if($consultation->requirements)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Specific Requirements</h3>
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-gray-700 leading-relaxed">{{ $consultation->requirements }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Admin Notes -->
                    @if($consultation->admin_notes)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Notes</h3>
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <p class="text-gray-700 leading-relaxed">{{ $consultation->admin_notes }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Consultation Details -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Consultation Details</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Submitted:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->created_at->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Time:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->created_at->format('h:i A') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Days ago:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->created_at->diffForHumans() }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Source:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ ucfirst($consultation->source) }}</span>
                                </div>
                                @if($consultation->contacted_at)
                                <div>
                                    <span class="text-gray-600">Contacted:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->contacted_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                                @if($consultation->assigned_to)
                                <div>
                                    <span class="text-gray-600">Assigned to:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->assigned_to }}</span>
                                </div>
                                @endif
                                @if($consultation->updated_at != $consultation->created_at)
                                <div class="md:col-span-2">
                                    <span class="text-gray-600">Last updated:</span>
                                    <span class="text-gray-900 font-medium ml-2">{{ $consultation->updated_at->diffForHumans() }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status Management -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Management</h3>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $consultation->status_badge }}">
                                {{ $consultation->formatted_status }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $consultation->priority_badge }}">
                                {{ $consultation->formatted_priority }}
                            </span>
                        </div>

                        @canDo('consultations.delete')
<form action="{{ route('admin.consultations.update-status', $consultation) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                    <option value="pending" {{ $consultation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $consultation->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="in_progress" {{ $consultation->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ $consultation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $consultation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                                <select name="priority" id="priority" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                    <option value="low" {{ $consultation->priority === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ $consultation->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ $consultation->priority === 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ $consultation->priority === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">Assigned To</label>
                                <input type="text" name="assigned_to" id="assigned_to" value="{{ $consultation->assigned_to }}" 
                                       placeholder="Agent/Admin name" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            </div>
                            
                            <div class="mb-4">
                                <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                                <textarea name="admin_notes" id="admin_notes" rows="3" 
                                          placeholder="Internal notes..."
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ $consultation->admin_notes }}</textarea>
                            </div>
                            
                            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="mailto:{{ $consultation->email }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Send Email
                            </a>
                            <a href="tel:{{ $consultation->phone }}" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Call Customer
                            </a>
                        </div>
                    </div>

                    <!-- Danger Zone -->
                    <div class="bg-white border border-red-200 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-red-700 mb-4">Danger Zone</h3>
                        <form action="{{ route('admin.consultations.destroy', $consultation) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this consultation? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Delete Consultation
                            </button>
                        </form>
@endCanDo
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection