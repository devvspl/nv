@extends('layouts.admin')

@section('title', 'View Blog Post')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Blog Post Details</h2>
                <div class="flex space-x-2">
                    @canDo('blogs.edit')
<a href="{{ route('admin.blogs.edit', $blog) }}" 
                       class="inline-flex items-center px-4 py-2 text-sm bg-zendo-gold text-white rounded-lg hover:bg-opacity-90">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to List
                    </a>
@endCanDo
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">
            @if($blog->featured_image)
                <div>
                    <img src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}" 
                         class="w-full h-96 object-cover rounded-lg">
                </div>
            @endif

            <div>
                <h1 class="text-3xl font-heading font-bold text-zendo-navy mb-2">{{ $blog->title }}</h1>
                <div class="flex flex-wrap gap-2 items-center text-sm text-gray-600">
                    @if($blog->author)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $blog->author }}
                        </span>
                    @endif
                    @if($blog->published_date)
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $blog->published_date->format('M d, Y') }}
                        </span>
                    @endif
                    @if($blog->category)
                        <span class="px-2 py-1 bg-zendo-gold bg-opacity-20 text-zendo-gold rounded-full text-xs font-medium">
                            {{ $blog->category }}
                        </span>
                    @endif
                    @if($blog->is_featured)
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                            Featured
                        </span>
                    @endif
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $blog->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $blog->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            @if($blog->excerpt)
                <div class="bg-gray-50 border-l-4 border-zendo-gold p-4 rounded">
                    <p class="text-gray-700 italic">{{ $blog->excerpt }}</p>
                </div>
            @endif

            <div class="prose max-w-none">
                <div class="text-gray-700 leading-relaxed">
                    {!! $blog->content !!}
                </div>
            </div>

            @if($blog->tags)
                <div class="pt-4 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Tags:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $blog->tags) as $tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="pt-4 border-t border-gray-200 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">Slug:</span>
                    <p class="font-medium text-gray-900">{{ $blog->slug }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Views:</span>
                    <p class="font-medium text-gray-900">{{ number_format($blog->views) }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Sort Order:</span>
                    <p class="font-medium text-gray-900">{{ $blog->sort_order }}</p>
                </div>
                <div>
                    <span class="text-gray-500">Created:</span>
                    <p class="font-medium text-gray-900">{{ $blog->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
