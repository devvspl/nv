@extends('layouts.app')
@section('title', 'Contact Us - ZendoIndia')
@section('content')
    <style>
        .about-banner-section {
            position: relative;
            background-image: url('{{ $banner->banner_image_url ?? "https://zendoindia.com/new-home/zendo/assets/images/bg/cta-bg.jpg" }}');
            background-size: cover;
            background-position: center;
            padding: 160px 0 80px;
            color: #fff;
        }

        .about-banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(0 0 0 / 62%);
        }

        .about-banner-container {
            position: relative;
            max-width: 1250px;
            margin: auto;
            padding: 0 20px;
        }

        .about-banner-left {
            max-width: 600px;
        }

        .about-banner-heading {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .about-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 16px;
        }

        .about-breadcrumb a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }

        .about-breadcrumb span {
            color: #ffffff;
        }

        .about-breadcrumb p {
            margin: 0;
            opacity: 0.8;
        }

        @media (max-width: 767px) {
            .about-banner-heading {
                font-size: 32px;
            }

            .about-breadcrumb {
                font-size: 14px;
            }

            .about-banner-section {
                padding: 130px 0 60px;
            }
        }
    </style>
    <section class="about-banner-section">
        <div class="about-banner-overlay"></div>
        <div class="about-banner-container">
            <div class="about-banner-left">
                <h1 class="about-banner-heading">{{ $banner->heading ?? 'Contact Us' }}</h1>
                <div class="about-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <p>Contact Us</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-pattern-white py-24 animate-on-scroll fade-in-up">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="section-subheading">{{ $contactSection->subheading ?? 'Contact Us' }}</span>
                <h2 class="font-heading text-zendo-navy">
                    {{ $contactSection->heading ?? "We'd Love to Hear From You — Reach Out!" }}
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="grid grid-cols-1 gap-8 card-grid-container">
                    @forelse($contactInfos as $info)
                        <div class="why-choose-card card-item bg-white rounded-lg shadow-xl p-6 border border-gray-100">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-14 h-14 bg-zendo-light-bg rounded-full flex items-center justify-center flex-shrink-0">
                                    <img src="{{ $info->icon_url }}" alt="{{ $info->title }}"
                                        class="w-7 h-7 text-zendo-gold">
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold font-heading text-zendo-navy mb-1">
                                        {{ strtoupper($info->title) }}
                                    </h3>
                                    <p class="text-gray-600 font-body text-sm leading-relaxed">
                                        {{ $info->content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="why-choose-card card-item bg-white rounded-lg shadow-xl p-6 border border-gray-100">
                            <p class="text-gray-600 text-center">No contact information available.</p>
                        </div>
                    @endforelse
                </div>
                <div class="bg-white rounded-lg shadow-xl p-10 border border-gray-100">
                    <h3 class="text-2xl font-heading font-semibold text-zendo-navy mb-6">
                        Send Us a Message
                    </h3>
                    
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zendo-gold">
                        <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zendo-gold">
                        <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zendo-gold">
                        <textarea name="message" rows="4" placeholder="Your Message" required
                            class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-zendo-gold">{{ old('message') }}</textarea>
                        <button type="submit"
                            class="w-full bg-zendo-gold text-white font-semibold py-3 rounded-md hover:opacity-90 transition">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="inquiry-section" class="py-24 animate-on-scroll fade-in-up">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div>
                <span class="section-subheading-dark-bg">{{ $inquirySection->subheading ?? 'Get Inquiry' }}</span>
                <h2 class="md:text-5xl font-heading text-white">{{ $inquirySection->heading ?? 'Your Luxurious Escape Awaits — Reserve Today' }}</h2>
                <p class="text-lg text-gray-300 font-body max-w-2xl mx-auto">
                    {{ $inquirySection->description ?? 'Step into a world of refined elegance and timeless comfort. Secure your unforgettable stay at our luxury hotel – it\'s just an inquiry away.' }}
                </p>
            </div>
            <div class="w-full max-w-6xl mx-auto mt-12">
                <form action="{{ route('inquiries.store') }}" method="POST"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center">
                    @csrf
                    <div>
                        <label for="name-2" class="sr-only">Name</label>
                        <input type="text" name="name" id="name-2" class="inquiry-form-input w-full"
                            placeholder="Name" required>
                    </div>
                    <div>
                        <label for="email-2" class="sr-only">Email</label>
                        <input type="email" name="email" id="email-2" class="inquiry-form-input w-full"
                            placeholder="Email" required>
                    </div>
                    <div>
                        <label for="phone-2" class="sr-only">Phone number</label>
                        <input type="tel" name="phone" id="phone-2" class="inquiry-form-input w-full"
                            placeholder="Phone number" required>
                    </div>
                    <div>
                        <label for="requirement-2" class="sr-only">Requirement</label>
                        <input type="text" name="message" id="requirement-2" class="inquiry-form-input w-full"
                            placeholder="Requirement" required>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full h-[56px] px-6 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all transform hover:scale-105 btn-anim btn-dark-bg">
                            Get Inquiry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
