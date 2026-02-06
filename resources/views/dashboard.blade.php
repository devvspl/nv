@extends('layouts.admin')

@section('title', 'Dashboard - ZendoIndia Admin')

@section('page-title', 'Dashboard')
@section('page-description')
Welcome back, {{ Auth::user()->name }}! Here's what's happening with your real estate business today.
@endsection

@section('content')

<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-zendo-navy to-gray-800 rounded-xl shadow-lg p-6 mb-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold font-heading mb-2">Good {{ date('H') < 12 ? 'Morning' : (date('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-gray-200">Today is {{ date('l, F j, Y') }}. Here's your business overview.</p>
        </div>
        <div class="hidden md:block">
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                <div class="text-center">
                    <p class="text-sm text-gray-200">Current Time</p>
                    <p class="text-xl font-bold" id="current-time">{{ date('H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-zendo-navy">{{ App\Models\User::count() }}</p>
                <p class="text-sm text-gray-600 font-medium">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        Registered users
                    </span>
                </p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Inquiries -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Inquiries</p>
                <p class="text-3xl font-bold text-zendo-navy">{{ App\Models\Inquiry::count() }}</p>
                <p class="text-sm text-yellow-600 font-medium">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                        </svg>
                        {{ App\Models\Inquiry::pending()->count() }} pending
                    </span>
                </p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Consultations -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Total Consultations</p>
                <p class="text-3xl font-bold text-zendo-navy">{{ App\Models\Consultation::count() }}</p>
                <p class="text-sm text-blue-600 font-medium">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        {{ App\Models\Consultation::pending()->count() }} pending
                    </span>
                </p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Active Cities -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 mb-1">Active Cities</p>
                <p class="text-3xl font-bold text-zendo-navy">{{ App\Models\City::where('status', true)->count() }}</p>
                <p class="text-sm text-purple-600 font-medium">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Service locations
                    </span>
                </p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Recent Consultations -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-zendo-navy font-heading">Recent Consultations</h3>
                <span class="text-sm text-gray-500">Latest requests</span>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $recentConsultations = App\Models\Consultation::latest()->take(3)->get();
                @endphp
                @forelse($recentConsultations as $consultation)
                <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-green-600 font-semibold text-sm">{{ $consultation->initials }}</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $consultation->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $consultation->property_type ? $consultation->property_type . ' consultation' : 'General consultation' }}</p>
                        <p class="text-xs text-gray-400">{{ $consultation->phone }} • {{ $consultation->formatted_inquiry_type }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ $consultation->created_at->diffForHumans() }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $consultation->status_badge }}">
                            {{ $consultation->formatted_status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-gray-500">No consultations yet</p>
                </div>
                @endforelse
            </div>
            <div class="mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.consultations.index') }}" class="inline-flex items-center text-zendo-navy hover:text-zendo-gold font-medium text-sm transition-colors">
                    View all consultations
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Inquiries -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-zendo-navy font-heading">Recent Inquiries</h3>
                <span class="text-sm text-gray-500">Latest leads</span>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @php
                    $recentInquiries = App\Models\Inquiry::latest()->take(3)->get();
                @endphp
                @forelse($recentInquiries as $inquiry)
                <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-sm">{{ $inquiry->initials }}</span>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $inquiry->name }}</h4>
                        <p class="text-sm text-gray-500">{{ $inquiry->property_type ? 'Interested in ' . $inquiry->property_type : 'General inquiry' }}</p>
                        <p class="text-xs text-gray-400">{{ $inquiry->phone }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ $inquiry->created_at->diffForHumans() }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $inquiry->status_badge }}">
                            {{ $inquiry->formatted_status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                    </svg>
                    <p class="text-gray-500">No inquiries yet</p>
                </div>
                @endforelse
            </div>
            <div class="mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center text-zendo-navy hover:text-zendo-gold font-medium text-sm transition-colors">
                    View all inquiries
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
    <h3 class="text-lg font-semibold text-zendo-navy font-heading mb-6">Quick Actions</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-zendo-gold hover:bg-zendo-light-bg transition-colors group">
            <div class="text-center">
                <svg class="w-8 h-8 mx-auto text-gray-400 group-hover:text-zendo-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <p class="text-sm font-medium text-gray-600 group-hover:text-zendo-navy">Add User</p>
            </div>
        </a>
        <a href="{{ route('admin.testimonials.create') }}" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-zendo-gold hover:bg-zendo-light-bg transition-colors group">
            <div class="text-center">
                <svg class="w-8 h-8 mx-auto text-gray-400 group-hover:text-zendo-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p class="text-sm font-medium text-gray-600 group-hover:text-zendo-navy">Add Testimonial</p>
            </div>
        </a>
        <a href="{{ route('admin.features.create') }}" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-zendo-gold hover:bg-zendo-light-bg transition-colors group">
            <div class="text-center">
                <svg class="w-8 h-8 mx-auto text-gray-400 group-hover:text-zendo-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
                <p class="text-sm font-medium text-gray-600 group-hover:text-zendo-navy">Add Feature</p>
            </div>
        </a>
        <a href="{{ route('admin.cities.create') }}" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-zendo-gold hover:bg-zendo-light-bg transition-colors group">
            <div class="text-center">
                <svg class="w-8 h-8 mx-auto text-gray-400 group-hover:text-zendo-gold mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="text-sm font-medium text-gray-600 group-hover:text-zendo-navy">Add City</p>
            </div>
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }

    // Update time every second
    setInterval(updateTime, 1000);
    
    // Initialize time on page load
    updateTime();
</script>
@endsection