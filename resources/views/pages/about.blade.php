@extends('layouts.app')
@section('title', 'About Us - ZendoIndia')
@section('content')
    <!-- ABOUT PAGE BANNER -->
    <style>
        .about-banner-section {
            position: relative;
            background-image: url('https://zendoindia.com/new-home/zendo/assets/images/bg/cta-bg.jpg');
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
                <h1 class="about-banner-heading">About Us</h1>
                <div class="about-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <p>About Us</p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-pattern-white py-24 animate-on-scroll fade-in-up">
        <!-- CHANGED bg -->
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="section-subheading">Our Company</span>
                <h2 class="font-heading text-zendo-navy">{{ $aboutPage->section_subtitle ?? 'Building Trust, Delivering Excellence' }}
                </h2>
            </div>
            <!-- Feature Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 card-grid-container">
                <!-- Card 1: Who We Are -->
                <div class="why-choose-card card-item bg-white rounded-lg shadow-xl p-8 text-center border border-gray-100">
                    <div class="w-20 h-20 mx-auto bg-zendo-light-bg rounded-full flex items-center justify-center mb-6">
                        @if ($aboutPage && $aboutPage->who_we_are_icon_url)
                            <img src="{{ $aboutPage->who_we_are_icon_url }}" alt="Who We Are Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @else
                            <img src="{{ asset('assets/icons/trustworthiness.svg') }}" alt="Who We Are Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold font-heading text-zendo-navy mb-3">
                        {{ $aboutPage->who_we_are_title ?? 'Who we are' }}</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        {{ $aboutPage->who_we_are_description ?? 'Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.' }}
                    </p>
                </div>
                <!-- Card 2: Mission -->
                <div class="why-choose-card card-item bg-white rounded-lg shadow-xl p-8 text-center border border-gray-100">
                    <div class="w-20 h-20 mx-auto bg-zendo-light-bg rounded-full flex items-center justify-center mb-6">
                        @if ($aboutPage && $aboutPage->mission_icon_url)
                            <img src="{{ $aboutPage->mission_icon_url }}" alt="Mission Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @else
                            <img src="{{ asset('assets/icons/residential.svg') }}" alt="Mission Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold font-heading text-zendo-navy mb-3">
                        {{ $aboutPage->mission_title ?? 'Mission' }}</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        {{ $aboutPage->mission_description ?? 'Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.' }}
                    </p>
                </div>
                <!-- Card 3: Vision -->
                <div class="why-choose-card card-item bg-white rounded-lg shadow-xl p-8 text-center border border-gray-100">
                    <div class="w-20 h-20 mx-auto bg-zendo-light-bg rounded-full flex items-center justify-center mb-6">
                        @if ($aboutPage && $aboutPage->vision_icon_url)
                            <img src="{{ $aboutPage->vision_icon_url }}" alt="Vision Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @else
                            <img src="{{ asset('assets/icons/coin.svg') }}" alt="Vision Icon"
                                class="w-10 h-10 text-zendo-gold">
                        @endif
                    </div>
                    <h3 class="text-xl font-semibold font-heading text-zendo-navy mb-3">
                        {{ $aboutPage->vision_title ?? 'Vision' }}</h3>
                    <p class="text-gray-600 font-body leading-relaxed">
                        {{ $aboutPage->vision_description ?? 'Aliquam dictum elit vitae mauris facilisis at dictum urna dignissim donec vel lectus vel felis.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- tab section -->
    <style>
        .abt-value-section {
            padding: 80px 0;
            background: #fbf8f2;
        }

        .abt-value-container {
            max-width: 1250px;
            margin: auto;
            padding: 0 20px;
        }

        .abt-value-main-headings {
            font-size: 40px;
            font-weight: 700;
            color: #0b2c3d;
            margin-bottom: 40px !important;
        }

        .abt-value-grid {
            display: grid;
            grid-template-columns: 25% 50% 25%;
            gap: 40px;
        }

        .abt-value-tabs {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .abt-tab-item {
            font-size: 18px;
            padding: 10px 0;
            cursor: pointer;
            position: relative;
            color: #0b2c3d;
            font-weight: 500;
        }

        .abt-tab-item .abt-arrow {
            opacity: 0;
            transition: 0.3s;
            margin-left: 6px;
        }

        .abt-tab-item.active {
            color: #b39359;
            font-weight: 700;
        }

        .abt-tab-item.active .abt-arrow {
            opacity: 1;
        }

        .abt-value-content h3 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #0b2c3d;
        }

        .abt-value-content p {
            line-height: 1.7;
            font-size: 16px;
            color: #444;
        }

        .abt-icon-card {
            padding: 40px;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .abt-icon-card img {
            width: 140px;
        }

        @media (max-width: 992px) {
            .abt-value-grid {
                grid-template-columns: 1fr;
            }

            .abt-icon-card img {
                width: 120px;
            }
        }
    </style>
    <section id="abtValueSection" class="abt-value-section">
        <div class="abt-value-container">
            <h2 class="abt-value-main-headings">{{ $aboutPage->values_heading ?? 'Our Values' }}</h2>
            <div class="abt-value-grid">
                <!-- LEFT TABS -->
                <div class="abt-value-tabs">
                    <div class="abt-tab-item active" data-tab="who">
                        Who We Are <span class="abt-arrow">→</span>
                    </div>
                    <div class="abt-tab-item" data-tab="mission">
                        Our Mission <span class="abt-arrow">→</span>
                    </div>
                    <div class="abt-tab-item" data-tab="vision">
                        Our Vision <span class="abt-arrow">→</span>
                    </div>
                    <div class="abt-tab-item" data-tab="pro">
                        Teamwork <span class="abt-arrow">→</span>
                    </div>
                </div>
                <!-- CONTENT AREA -->
                <div class="abt-value-content">
                    <div class="abt-content-box" id="tab-who">
                        <h3>Who We Are</h3>
                        <p>{{ $aboutPage->values_who_we_are ?? 'We are a passionate and dedicated team committed to delivering high-quality work and creating meaningful value.' }}
                        </p>
                    </div>
                    <div class="abt-content-box" id="tab-mission" style="display:none;">
                        <h3>Our Mission</h3>
                        <p>{{ $aboutPage->values_mission ?? 'Our mission is to provide innovative, customer-focused solutions that inspire growth and long-term success.' }}
                        </p>
                    </div>
                    <div class="abt-content-box" id="tab-vision" style="display:none;">
                        <h3>Our Vision</h3>
                        <p>{{ $aboutPage->values_vision ?? 'Our vision is to become a leader in our industry through innovation, dedication, and an unwavering commitment to excellence.' }}
                        </p>
                    </div>
                    <div class="abt-content-box" id="tab-pro" style="display:none;">
                        <h3>Teamwork</h3>
                        <p>{{ $aboutPage->values_teamwork ?? 'Our vision is to become a leader in our industry through innovation, dedication, and an unwavering commitment to excellence.' }}
                        </p>
                    </div>
                </div>
                <!-- RIGHT ICON BOX -->
                <div class="abt-value-iconbox">
                    <div class="abt-icon-card">
                        <img id="abtIconImage" src="https://cdn-icons-png.flaticon.com/512/992/992651.png" alt="Icon">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tabs = document.querySelectorAll(".abt-tab-item");

            const icons = {
                who: "https://cdn-icons-png.flaticon.com/512/992/992651.png",
                mission: "https://cdn-icons-png.flaticon.com/512/1828/1828884.png",
                vision: "https://cdn-icons-png.flaticon.com/512/3135/3135715.png",
                pro: "https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
            };

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {

                    // Remove active from previous
                    tabs.forEach(t => t.classList.remove("active"));
                    this.classList.add("active");

                    let target = this.getAttribute("data-tab");

                    // Hide all content
                    document.querySelectorAll(".abt-content-box").forEach(box => box.style.display =
                        "none");

                    // Show active content
                    document.getElementById("tab-" + target).style.display = "block";

                    // Update icon
                    document.getElementById("abtIconImage").src = icons[target];
                });
            });
        });
    </script>
    <!-- logo section -->
    <!-- CLIENTS SECTION -->
    <section class="clients-section">
        <div class="clients-container">
            <h2 class="clients-headings">Our clients</h2>
            <div class="clients-grid">
                @forelse($clients as $client)
                    <div class="client-item">
                        <img src="{{ $client->logo_url }}" alt="{{ $client->name }}">
                    </div>
                @empty
                    <div class="client-item" style="grid-column: 1 / -1; text-align: center;">
                        <p class="text-gray-600">No clients added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- CSS -->
    <style>
        .clients-section {
            padding: 80px 0;
            background: white;
        }

        .clients-container {
            max-width: 1250px;
            margin: auto;
            padding: 0 20px;
        }

        .clients-headings {
            font-size: 38px;
            font-weight: 700;
            color: #0b2c3d;
            margin-bottom: 40px !important;
        }

        .clients-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
        }

        .client-item {
            padding: 35px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-right: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .client-item img {
            max-width: 100%;
            max-height: 90px;
            object-fit: contain;
            filter: drop-shadow(0px 0px 0px #000);
        }

        .clients-grid .client-item:nth-child(5n) {
            border-right: none;
        }

        .clients-grid .client-item:nth-last-child(-n+5) {
            border-bottom: none;
        }

        @media (max-width: 992px) {
            .clients-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .clients-grid .client-item:nth-child(3n) {
                border-right: none;
            }

            .clients-grid .client-item:nth-last-child(-n+3) {
                border-bottom: none;
            }
        }

        @media (max-width: 600px) {
            .clients-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .client-item img {
                max-width: 90px;
            }

            .clients-grid .client-item:nth-child(2n) {
                border-right: none;
            }

            .clients-grid .client-item:nth-last-child(-n+2) {
                border-bottom: none;
            }
        }
    </style>
    <!-- Our recoginzation-->
    <!--- profile section -->
    <section class="bg-pattern-light py-24 animate-on-scroll fade-in-up">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="section-subheading">{{ $aboutPage->team_section_title ?? 'Our Team Members' }}</span>
                <h2 class="font-heading text-zendo-navy">
                    {{ $aboutPage->team_section_heading ?? 'What We Think About Our Company' }}
                </h2>
            </div>
            <!-- Team Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 card-grid-container">
                @forelse($teamMembers as $member)
                    <!-- Team Member Card -->
                    <div class="blog-card card-item bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                        <a href="{{ $member->linkedin_url ?? '#' }}" target="_blank">
                            <div class="overflow-hidden">
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}"
                                    class="card-image w-full h-48 object-cover">
                            </div>
                            <div class="p-6">
                                <h3
                                    class="text-xl font-semibold font-heading text-zendo-navy hover:text-zendo-gold transition-colors mb-3">
                                    {{ $member->name }}</h3>
                                @if ($member->position)
                                    <p class="text-sm text-gray-600 font-body mb-2">{{ $member->position }}</p>
                                @endif
                                @if ($member->linkedin_url)
                                    <div class="flex items-center text-xs text-gray-500 font-body">
                                        <span>LinkedIn</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <!-- No Team Members -->
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-600 font-body text-lg">No team members added yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ended -->
    <!-- cta button -->
    <section id="inquiry-section" class="py-24 animate-on-scroll fade-in-up">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- CHANGED -->
            <!-- Left Content -->
            <div>
                <!-- REMOVED grid classes -->
                <span class="section-subheading-dark-bg">Get Inquiry</span>
                <!-- REMOVED text-4xl, md:text-5xl, font-medium, mb-6 -->
                <h2 class="md:text-5xl font-heading text-white">Your Luxurious Escape Awaits — Reserve Today</h2>
                <p class="text-lg text-gray-300 font-body max-w-2xl mx-auto">
                    <!-- Centered text -->
                    Step into a world of refined elegance and timeless comfort. Secure your unforgettable stay at our luxury
                    hotel – it's just an inquiry away.
                </p>
            </div>
            <!-- Right Form -->
            <div class="w-full max-w-6xl mx-auto mt-12">
                <form action="#" method="POST"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-center">
                    <!-- CHANGED -->
                    <div>
                        <label for="name-2" class="sr-only">Name</label>
                        <input type="text" name="name-2" id="name-2" class="inquiry-form-input w-full"
                            placeholder="Name">
                    </div>
                    <div>
                        <label for="email-2" class="sr-only">Email</label>
                        <input type="email" name="email-2" id="email-2" class="inquiry-form-input w-full"
                            placeholder="Email">
                    </div>
                    <div>
                        <label for="phone-2" class="sr-only">Phone number</label>
                        <input type="tel" name="phone-2" id="phone-2" class="inquiry-form-input w-full"
                            placeholder="Phone number">
                    </div>
                    <div>
                        <label for="requirement-2" class="sr-only">Requirement</label>
                        <input type="text" name="requirement-2" id="requirement-2" class="inquiry-form-input w-full"
                            placeholder="Requirement"> <!-- CHANGED from textarea -->
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full h-[56px] px-6 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all transform hover:scale-105 btn-anim btn-dark-bg">
                            <!-- Set height -->
                            Get Inquiry
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ended-->
@endsection
