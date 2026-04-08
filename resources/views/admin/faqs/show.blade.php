@extends('layouts.admin')

@section('title', 'View FAQ - ZendoIndia Admin')

@section('page-title', 'FAQ Details')
@section('page-description')
View the complete FAQ information.
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.faqs.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to FAQs
        </a>
    </div>

    <!-- FAQ Details Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">FAQ Information</h3>
                <p class="mt-1 text-sm text-gray-600">Complete details of the FAQ.</p>
            </div>
            <div class="flex items-center space-x-3">
                @if($faq->is_active)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        Inactive
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 space-y-6">
            <!-- Question -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Question</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-900 font-medium">{{ $faq->question }}</p>
                </div>
            </div>

            <!-- Answer -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Answer</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $faq->answer }}</p>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 font-medium">{{ $faq->sort_order }}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Created</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 text-sm">{{ $faq->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Updated</label>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-gray-900 text-sm">{{ $faq->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                @canDo('faqs.delete')
<form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="px-4 py-2 border border-{{ $faq->is_active ? 'red' : 'green' }}-300 rounded-lg text-sm font-medium text-{{ $faq->is_active ? 'red' : 'green' }}-700 bg-white hover:bg-{{ $faq->is_active ? 'red' : 'green' }}-50 transition-colors">
                        {{ $faq->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                </form>
                @canDo('faqs.edit')
<a href="{{ route('admin.faqs.edit', $faq) }}" 
                   class="px-4 py-2 bg-zendo-gold text-white rounded-lg text-sm font-medium hover:bg-zendo-navy transition-colors">
                    Edit FAQ
                </a>
@endCanDo
                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" 
                      onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors">
                        Delete FAQ
                    </button>
                </form>
@endCanDo
            </div>
        </div>
    </div>
</div>
@endsection