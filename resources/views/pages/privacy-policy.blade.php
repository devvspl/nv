@extends('layouts.app')

@section('title', 'Privacy Policy - ZendoIndia')

@section('content')
    <!-- PRIVACY POLICY HERO -->
    <section class="relative bg-zendo-navy py-20 pt-32">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-heading text-white font-bold mb-6">
                    {{ $policy->title ?? 'Privacy Policy' }}
                </h1>
                @if($policy && $policy->last_updated)
                    <p class="text-gray-300 text-lg">
                        Last Updated: {{ $policy->last_updated->format('F d, Y') }}
                    </p>
                @endif
                @if($policy && $policy->effective_date)
                    <p class="text-gray-300 text-sm mt-2">
                        Effective Date: {{ $policy->effective_date->format('F d, Y') }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- PRIVACY POLICY CONTENT -->
    <section class="bg-pattern-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($policy)
                <div class="bg-white rounded-lg shadow-xl p-8 md:p-12">
                    <div class="prose prose-lg max-w-none privacy-content">
                        {!! $policy->content !!}
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-xl p-8 md:p-12 text-center">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-heading text-zendo-navy mb-4">Privacy Policy Not Available</h2>
                    <p class="text-gray-600 font-body mb-6">
                        We're currently updating our privacy policy. Please check back soon or contact us for more information.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-block px-6 py-3 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all">
                        Contact Us
                    </a>
                </div>
            @endif

            <!-- Back to Home -->
            <div class="text-center mt-8">
                <a href="{{ route('home') }}" class="inline-flex items-center text-zendo-gold hover:text-zendo-navy transition-colors font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </section>
@endsection

@section('styles')
<style>
    .privacy-content h1,
    .privacy-content h2,
    .privacy-content h3,
    .privacy-content h4,
    .privacy-content h5,
    .privacy-content h6 {
        font-family: var(--font-heading);
        color: #0b2c3d;
        font-weight: 700;
        margin-top: 1.5em;
        margin-bottom: 0.75em;
    }

    .privacy-content h1 {
        font-size: 2.25em;
    }

    .privacy-content h2 {
        font-size: 1.875em;
    }

    .privacy-content h3 {
        font-size: 1.5em;
    }

    .privacy-content h4 {
        font-size: 1.25em;
    }

    .privacy-content p {
        margin-bottom: 1.25em;
        line-height: 1.8;
        color: #4b5563;
    }

    .privacy-content ul,
    .privacy-content ol {
        margin-bottom: 1.25em;
        padding-left: 2em;
    }

    .privacy-content li {
        margin-bottom: 0.5em;
        line-height: 1.7;
    }

    .privacy-content a {
        color: #b39359;
        text-decoration: underline;
    }

    .privacy-content a:hover {
        color: #0b2c3d;
    }

    .privacy-content strong {
        font-weight: 600;
        color: #0b2c3d;
    }

    .privacy-content blockquote {
        border-left: 4px solid #b39359;
        padding-left: 1.5em;
        margin: 1.5em 0;
        font-style: italic;
        color: #4b5563;
    }

    .privacy-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5em 0;
    }

    .privacy-content table th,
    .privacy-content table td {
        border: 1px solid #e5e7eb;
        padding: 0.75em;
        text-align: left;
    }

    .privacy-content table th {
        background-color: #f3f4f6;
        font-weight: 600;
    }
</style>
@endsection
