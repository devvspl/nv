@extends('layouts.app')

@section('title', 'Blog & News - ZendoIndia')

@section('content')
<!-- BLOG HERO -->
<section class="relative bg-zendo-navy py-20 pt-32">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-heading text-white font-bold mb-6">
                Blog & News
            </h1>
            <p class="text-lg text-gray-300 font-body max-w-2xl mx-auto">
                Stay updated with the latest real estate trends, market insights, and property news.
            </p>
        </div>
    </div>
</section>

<!-- BLOG LISTING -->
<section class="bg-pattern-white py-16">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                <div class="blog-card bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-shadow">
                    <a href="{{ route('blogs.show', $blog->slug) }}">
                        <div class="overflow-hidden">
                            <img src="{{ $blog->featured_image_url }}" alt="{{ $blog->title }}"
                                 class="w-full h-56 object-cover hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-6">
                            @if($blog->category)
                                <span class="inline-block px-3 py-1 bg-zendo-gold text-white text-xs font-semibold rounded-full mb-3">
                                    {{ $blog->category }}
                                </span>
                            @endif
                            <h3 class="text-xl font-semibold font-heading text-zendo-navy hover:text-zendo-gold transition-colors mb-3">
                                {{ $blog->title }}
                            </h3>
                            <p class="text-gray-600 font-body text-sm leading-relaxed mb-4 line-clamp-3">
                                {{ $blog->excerpt }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500 font-body">
                                <span>{{ $blog->published_date ? $blog->published_date->format('M d, Y') : 'Draft' }}</span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ number_format($blog->views) }}
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 font-body text-lg">No blog posts available at the moment.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($blogs->hasPages())
            <div class="mt-12">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
