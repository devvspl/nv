@extends('layouts.admin')

@section('title', 'Work Process Step Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
            <a href="{{ route('admin.work-processes.index') }}" class="hover:text-zendo-gold">Work Processes</a>
            <span>/</span>
            <span>Step Details</span>
        </div>
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-heading text-zendo-navy font-semibold">Work Process Step Details</h2>
            <div class="flex gap-2">
                @canDo('work-processes.edit')
<a href="{{ route('admin.work-processes.edit', $workProcess) }}"
                   class="px-4 py-2 bg-zendo-gold text-white font-medium rounded-lg hover:bg-zendo-navy transition-colors">
                    Edit
                </a>
@endCanDo
                <form action="{{ route('admin.work-processes.destroy', $workProcess) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this step?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-zendo-navy to-zendo-gold p-8 text-white">
            <div class="flex items-center gap-6">
                <div class="flex items-center justify-center w-20 h-20 rounded-full bg-white text-zendo-navy font-bold text-3xl">
                    {{ $workProcess->step_number }}
                </div>
                <div>
                    <h3 class="text-2xl font-bold">{{ $workProcess->title }}</h3>
                    <p class="text-sm opacity-90 mt-1">Step {{ $workProcess->step_number }} • Display Order: {{ $workProcess->display_order }}</p>
                </div>
            </div>
        </div>

        <!-- Details -->
        <div class="p-8">
            <!-- Description Section -->
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Description</h4>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <p class="text-gray-700 leading-relaxed">{{ $workProcess->description }}</p>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Step Number -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Step Number</h4>
                    <p class="text-gray-900 font-medium">{{ $workProcess->step_number }}</p>
                </div>

                <!-- Display Order -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Display Order</h4>
                    <p class="text-gray-900 font-medium">{{ $workProcess->display_order }}</p>
                </div>

                <!-- Status -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Status</h4>
                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded {{ $workProcess->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $workProcess->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <!-- Icon -->
                <div>
                    <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Icon</h4>
                    @if($workProcess->icon)
                        <img src="{{ asset('storage/' . $workProcess->icon) }}" alt="Icon" class="w-16 h-16 object-cover rounded">
                    @else
                        <p class="text-gray-500 text-sm">No icon uploaded</p>
                    @endif
                </div>
            </div>

            <!-- Timestamps -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                    <div>
                        <span class="font-medium">Created:</span>
                        {{ $workProcess->created_at->format('M d, Y h:i A') }}
                    </div>
                    <div>
                        <span class="font-medium">Last Updated:</span>
                        {{ $workProcess->updated_at->format('M d, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
