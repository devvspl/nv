<header id="main-header" class="fixed top-0 z-50 w-full transition-all duration-300">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-3xl font-heading">
                <img src="{{ asset('main/images/zendo.png') }}" alt="ZENDO India Logo" class="h-10 w-auto header-logo-img">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('about') }}" class="header-nav-link font-highlight font-medium">About Us</a>
                <a href="#" class="header-nav-link font-highlight font-medium">Services</a>
                <a href="{{ route('blogs.index') }}" class="header-nav-link font-highlight font-medium">Blog/News</a>
                <a href="{{ route('contact') }}" class="header-nav-link font-highlight font-medium">Contact Us</a>

                <a href="tel:+919990186086"
                    class="header-button btn-anim ml-4 px-5 py-2.5 rounded-full font-highlight font-medium shadow-lg transform hover:scale-105">
                    +91 9990186086
                </a>
            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="focus:outline-none transition-colors duration-300">
                    <svg id="menu-icon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <svg id="close-icon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="hidden md:hidden bg-zendo-light-bg shadow-xl absolute top-20 left-0 w-full z-40">
        <div class="flex flex-col space-y-4 p-5">
            <a href="{{ route('about') }}"
                class="block px-3 py-2 rounded-md font-highlight font-semibold text-gray-700 hover:bg-gray-100 hover:text-zendo-navy">About
                Us</a>
            <a href="{{ route('contact') }}"
                class="block px-3 py-2 rounded-md font-highlight font-semibold text-gray-700 hover:bg-gray-100 hover:text-zendo-navy">Contact
                Us</a>
            <a href="#"
                class="block px-3 py-2 rounded-md font-highlight font-semibold text-gray-700 hover:bg-gray-100 hover:text-zendo-navy">Services</a>
            <a href="{{ route('blogs.index') }}"
                class="block px-3 py-2 rounded-md font-highlight font-semibold text-gray-700 hover:bg-gray-100 hover:text-zendo-navy">Blog/News</a>

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="w-full text-center mt-2 px-5 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all btn-anim btn-light-bg">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full text-center mt-2 px-5 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all btn-anim btn-light-bg">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="w-full text-center mt-2 px-5 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all btn-anim btn-light-bg">
                            Register
                        </a>
                    @endif
                @endauth
            @else
                <a href="tel:+919990186086"
                    class="w-full text-center mt-2 px-5 py-3 rounded-full font-highlight font-semibold shadow-lg transition-all btn-anim btn-light-bg">
                    Connect Now
                </a>
            @endif
        </div>
    </div>
</header>
