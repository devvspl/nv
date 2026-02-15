<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - ZendoIndia')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Forum&family=Nunito+Sans:wght@400;500;700&family=Raleway:wght@500;700&display=swap"
        rel="stylesheet">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'zendo-navy': '#0B2C3D',
                        'zendo-gold': '#B39359',
                        'zendo-light-bg': '#FBF8F2',
                        'admin-sidebar': '#1F2937',
                        'admin-sidebar-hover': '#374151',
                    },
                    fontFamily: {
                        heading: ['Forum', 'cursive'],
                        body: ['"Nunito Sans"', 'sans-serif'],
                        highlight: ['Raleway', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Forum', cursive;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            background: linear-gradient(180deg, #1F2937 0%, #111827 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-sidebar-link {
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .admin-sidebar-link:hover {
            background-color: rgba(55, 65, 81, 0.8);
            transform: translateX(2px);
        }

        .admin-sidebar-link.active {
            background: linear-gradient(90deg, #B39359 0%, #9a7c4d 100%);
            color: white;
            /* box-shadow: 0 2px 8px rgba(179, 147, 89, 0.3); */
        }

        .admin-sidebar-link.active:hover {
            background: linear-gradient(90deg, #9a7c4d 0%, #B39359 100%);
            transform: translateX(0);
        }

        .admin-sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #ffffff;
        }

        /* Simple Dropdown Styles */
        .dropdown-submenu {
            margin-left: 2px;
            border-left: 2px solid rgba(179, 147, 89, 0.2);
            /* padding-left: 8px; */
        }

        .dropdown-submenu .admin-sidebar-link {
            padding: 8px 12px;
            margin: 2px 0;
            font-size: 13px;
            background: transparent !important;
        }

        .dropdown-submenu .admin-sidebar-link:hover {
            transform: translateX(0);
            background: transparent !important;
            color: #B39359;
        }

        .dropdown-submenu .admin-sidebar-link.active {
            background: transparent !important;
            color: #B39359;
            font-weight: 500;
        }

        .dropdown-submenu .admin-sidebar-link.active::before {
            width: 2px;
            background: #B39359;
        }

        /* Header Styles */
        .admin-header {
            background: linear-gradient(90deg, #ffffff 0%, #f9fafb 100%);
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        /* Footer Styles */
        .admin-footer {
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }

        /* Main Content Area */
        .admin-main-content {
            min-height: calc(100vh - 140px);
            background: #f3f4f6;
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        /* Custom Checkbox Styling - Change blue to gold */
        input[type="checkbox"] {
            accent-color: rgb(179, 147, 89);
        }
        
        input[type="checkbox"]:checked {
            background-color: rgb(179, 147, 89);
            border-color: rgb(179, 147, 89);
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
        }
        
        input[type="checkbox"]:focus {
            --tw-ring-color: rgb(179, 147, 89);
            border-color: rgb(179, 147, 89);
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #B39359;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9a7c4d;
        }

        /* Logo section */
        .admin-logo-section {
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }

            .admin-main-content {
                margin-left: 0 !important;
            }
        }

        /* Collapsed sidebar styles */
        .admin-sidebar.w-20 .admin-sidebar-link {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Alpine.js cloak */
        [x-cloak] {
            display: none !important;
        }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-100 font-body overflow-x-hidden">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true' }" 
         x-init="$watch('sidebarCollapsed', value => localStorage.setItem('sidebarCollapsed', value))">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" x-cloak></div>
        <!-- Sidebar -->
        <div class="admin-sidebar fixed h-full z-50 lg:z-30 transition-all duration-300" 
             :class="{ 
                'mobile-open': sidebarOpen,
                'w-64': !sidebarCollapsed,
                'w-20': sidebarCollapsed
             }">
            <!-- Logo Section -->
            <div class="admin-logo-section p-5">
                <div class="flex items-center" :class="{ 'justify-center': sidebarCollapsed }">
                    <div class="w-10 h-10 bg-zendo-gold rounded-lg flex items-center justify-center" 
                         :class="{ 'mr-3': !sidebarCollapsed }">
                        <span class="text-white font-bold text-lg">Z</span>
                    </div>
                    <div x-show="!sidebarCollapsed" x-transition>
                        <h2 class="text-white font-heading text-lg font-semibold">ZendoIndia</h2>
                        <p class="text-gray-300 text-xs">Admin Panel</p>
                    </div>
                </div>
                <!-- Collapse Toggle Button (Desktop Only) -->
                <button @click="sidebarCollapsed = !sidebarCollapsed" 
                        class="hidden lg:flex absolute -right-3 top-8 w-6 h-6 bg-zendo-gold rounded-full items-center justify-center text-white hover:bg-zendo-navy transition-colors shadow-lg z-50">
                    <svg class="w-3 h-3 transition-transform duration-300" 
                         :class="{ 'rotate-180': sidebarCollapsed }" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
            <!-- Navigation -->
            <nav class="mt-2 custom-scrollbar overflow-y-auto h-full pb-20">
                <div class="px-3 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="admin-sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-300 hover:text-white' }}"
                        :class="{ 'justify-center': sidebarCollapsed }"
                        x-data="{ tooltip: false }"
                        @mouseenter="tooltip = sidebarCollapsed"
                        @mouseleave="tooltip = false">
                        <svg class="w-5 h-5 flex-shrink-0" :class="{ 'mr-3': !sidebarCollapsed }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Dashboard</span>
                        <!-- Tooltip -->
                        <div x-show="tooltip" x-cloak
                             class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded whitespace-nowrap z-50">
                            Dashboard
                        </div>
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}"
                        class="admin-sidebar-link flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'active' : 'text-gray-300 hover:text-white' }}"
                        :class="{ 'justify-center': sidebarCollapsed }"
                        x-data="{ tooltip: false }"
                        @mouseenter="tooltip = sidebarCollapsed"
                        @mouseleave="tooltip = false">
                        <svg class="w-5 h-5 flex-shrink-0" :class="{ 'mr-3': !sidebarCollapsed }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                        <span x-show="!sidebarCollapsed" x-transition>Users</span>
                        <!-- Tooltip -->
                        <div x-show="tooltip" x-cloak
                             class="absolute left-full ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded whitespace-nowrap z-50">
                            Users
                        </div>
                    </a>

                    <!-- Lead Management Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.inquiries.*', 'admin.consultations.*') ? 'true' : 'false' }}, showFloating: false }" 
                         @mouseenter="showFloating = sidebarCollapsed" 
                         @mouseleave="showFloating = false"
                         class="relative">
                        <!-- Dropdown Toggle -->
                        <button @click="open = !open"
                            class="admin-sidebar-link w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.inquiries.*', 'admin.consultations.*') ? 'active' : 'text-gray-300 hover:text-white' }}"
                            :class="{ 'justify-center': sidebarCollapsed }">
                            <div class="flex items-center" :class="{ 'justify-center w-full': sidebarCollapsed }">
                                <svg class="w-5 h-5 flex-shrink-0" :class="{ 'mr-3': !sidebarCollapsed }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                    </path>
                                </svg>
                                <span x-show="!sidebarCollapsed" x-transition>Lead Management</span>
                                @php
                                    $totalPendingLeads = App\Models\Inquiry::pending()->count() + App\Models\Consultation::pending()->count();
                                @endphp
                                @if($totalPendingLeads > 0)
                                    <span x-show="!sidebarCollapsed" class="ml-2 inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 min-w-[18px] h-4 justify-center">
                                        {{ $totalPendingLeads }}
                                    </span>
                                    <span x-show="sidebarCollapsed" class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500"></span>
                                @endif
                            </div>
                            <svg x-show="!sidebarCollapsed" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Floating Menu (Collapsed State) -->
                        <div x-show="showFloating && sidebarCollapsed" x-cloak
                             class="absolute left-full top-0 ml-2 w-56 bg-gray-800 rounded-lg shadow-xl py-2 z-50 border border-gray-700">
                            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-700 mb-2">
                                Lead Management
                            </div>
                            <a href="{{ route('admin.inquiries.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.inquiries.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7">
                                    </path>
                                </svg>
                                Inquiries
                                @if(App\Models\Inquiry::pending()->count() > 0)
                                    <span class="ml-auto inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ App\Models\Inquiry::pending()->count() }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ route('admin.consultations.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.consultations.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Consultations
                                @if(App\Models\Consultation::pending()->count() > 0)
                                    <span class="ml-auto inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ App\Models\Consultation::pending()->count() }}
                                    </span>
                                @endif
                            </a>
                        </div>

                        <!-- Dropdown Menu (Expanded State) -->
                        <div x-show="open && !sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="dropdown-submenu mt-1">

                            <!-- Inquiries -->
                            <a href="{{ route('admin.inquiries.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.inquiries.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7">
                                    </path>
                                </svg>
                                Inquiries
                                @if(App\Models\Inquiry::pending()->count() > 0)
                                    <span class="ml-auto inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 min-w-[18px] h-4 justify-center">
                                        {{ App\Models\Inquiry::pending()->count() }}
                                    </span>
                                @endif
                            </a>

                            <!-- Consultations -->
                            <a href="{{ route('admin.consultations.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.consultations.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Consultations
                                @if(App\Models\Consultation::pending()->count() > 0)
                                    <span class="ml-auto inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 min-w-[18px] h-4 justify-center">
                                        {{ App\Models\Consultation::pending()->count() }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>

                    <!-- Property Management Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.service-types.*', 'admin.property-types.*', 'admin.locations.*', 'admin.project-statuses.*', 'admin.bhks.*', 'admin.builders.*', 'admin.amenities.*', 'admin.properties.*', 'admin.property-inquiries.*') ? 'true' : 'false' }}, showFloating: false }" 
                         @mouseenter="showFloating = sidebarCollapsed" 
                         @mouseleave="showFloating = false"
                         class="relative">
                        <!-- Dropdown Toggle -->
                        <button @click="open = !open"
                            class="admin-sidebar-link w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.service-types.*', 'admin.property-types.*', 'admin.locations.*', 'admin.project-statuses.*', 'admin.bhks.*', 'admin.builders.*', 'admin.amenities.*', 'admin.properties.*', 'admin.property-inquiries.*') ? 'active' : 'text-gray-300 hover:text-white' }}"
                            :class="{ 'justify-center': sidebarCollapsed }">
                            <div class="flex items-center" :class="{ 'justify-center w-full': sidebarCollapsed }">
                                <svg class="w-5 h-5 flex-shrink-0" :class="{ 'mr-3': !sidebarCollapsed }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                    </path>
                                </svg>
                                <span x-show="!sidebarCollapsed" x-transition>Property Management</span>
                            </div>
                            <svg x-show="!sidebarCollapsed" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Floating Menu (Collapsed State) -->
                        <div x-show="showFloating && sidebarCollapsed" x-cloak
                             class="absolute left-full top-0 ml-2 w-56 bg-gray-800 rounded-lg shadow-xl py-2 z-50 border border-gray-700">
                            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-700 mb-2">
                                Property Management
                            </div>
                            
                            <a href="{{ route('admin.service-types.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.service-types.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Service Types
                            </a>

                            <a href="{{ route('admin.property-types.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.property-types.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Property Types
                            </a>

                            <a href="{{ route('admin.locations.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.locations.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                                Locations
                            </a>

                            <a href="{{ route('admin.project-statuses.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.project-statuses.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Project Statuses
                            </a>

                            <a href="{{ route('admin.bhks.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.bhks.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                BHK
                            </a>

                            <a href="{{ route('admin.builders.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.builders.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Builders
                            </a>

                            <a href="{{ route('admin.amenities.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.amenities.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                    </path>
                                </svg>
                                Amenities
                            </a>

                            <div class="border-t border-gray-700 my-2"></div>

                            <a href="{{ route('admin.properties.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.properties.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z">
                                    </path>
                                </svg>
                                Properties
                            </a>

                            <a href="{{ route('admin.property-inquiries.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.property-inquiries.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                                Property Inquiries
                            </a>
                        </div>

                        <!-- Dropdown Menu (Expanded State) -->
                        <div x-show="open && !sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="dropdown-submenu mt-1">

                            <!-- Service Types -->
                            <a href="{{ route('admin.service-types.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.service-types.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Service Types
                            </a>

                            <!-- Property Types -->
                            <a href="{{ route('admin.property-types.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.property-types.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                Property Types
                            </a>

                            <!-- Locations -->
                            <a href="{{ route('admin.locations.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.locations.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>
                                </svg>
                                Locations
                            </a>

                            <!-- Project Statuses -->
                            <a href="{{ route('admin.project-statuses.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.project-statuses.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                Project Statuses
                            </a>

                            <!-- BHK -->
                            <a href="{{ route('admin.bhks.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bhks.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                                BHK
                            </a>

                            <!-- Builders -->
                            <a href="{{ route('admin.builders.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.builders.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Builders
                            </a>

                            <!-- Amenities -->
                            <a href="{{ route('admin.amenities.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.amenities.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                    </path>
                                </svg>
                                Amenities
                            </a>

                            <div class="border-t border-gray-700 my-2 mx-4"></div>

                            <!-- Properties -->
                            <a href="{{ route('admin.properties.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.properties.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z">
                                    </path>
                                </svg>
                                Properties
                            </a>

                            <!-- Property Inquiries -->
                            <a href="{{ route('admin.property-inquiries.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.property-inquiries.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                    </path>
                                </svg>
                                Property Inquiries
                            </a>

                            <!-- Work Processes -->
                            <a href="{{ route('admin.work-processes.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.work-processes.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                    </path>
                                </svg>
                                How We Work
                            </a>
                                    </path>
                                </svg>
                                
                            </a>
                        </div>
                    </div>

                    <!-- Home Page Master Dropdown -->
                    <div x-data="{ open: {{ request()->routeIs('admin.hero-sections.*', 'admin.about-us.*', 'admin.features.*', 'admin.categories.*', 'admin.cities.*', 'admin.testimonials.*', 'admin.faqs.*', 'admin.commercial-sections.*') ? 'true' : 'false' }}, showFloating: false }" 
                         @mouseenter="showFloating = sidebarCollapsed" 
                         @mouseleave="showFloating = false"
                         class="relative">
                        <!-- Dropdown Toggle -->
                        <button @click="open = !open"
                            class="admin-sidebar-link w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.hero-sections.*', 'admin.about-us.*', 'admin.features.*', 'admin.categories.*', 'admin.cities.*', 'admin.testimonials.*', 'admin.faqs.*', 'admin.commercial-sections.*') ? 'active' : 'text-gray-300 hover:text-white' }}"
                            :class="{ 'justify-center': sidebarCollapsed }">
                            <div class="flex items-center" :class="{ 'justify-center w-full': sidebarCollapsed }">
                                <svg class="w-5 h-5 flex-shrink-0" :class="{ 'mr-3': !sidebarCollapsed }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                </svg>
                                <span x-show="!sidebarCollapsed" x-transition>Home Master</span>
                            </div>
                            <svg x-show="!sidebarCollapsed" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Floating Menu (Collapsed State) -->
                        <div x-show="showFloating && sidebarCollapsed" x-cloak
                             class="absolute left-full top-0 ml-2 w-56 bg-gray-800 rounded-lg shadow-xl py-2 z-50 border border-gray-700">
                            <div class="px-3 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider border-b border-gray-700 mb-2">
                                Home Master
                            </div>
                            
                            <a href="{{ route('admin.hero-sections.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.hero-sections.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z">
                                    </path>
                                </svg>
                                Hero Sections
                            </a>
                            
                            <a href="{{ route('admin.about-us.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.about-us.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                About Us
                            </a>

                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14-7H3a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zM9 7h1m4 0h1m-5.5 5h1m4 0h1m-5.5 5h1m4 0h1">
                                    </path>
                                </svg>
                                Categories
                            </a>

                            <a href="{{ route('admin.cities.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.cities.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Cities
                            </a>

                            <a href="{{ route('admin.commercial-sections.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.commercial-sections.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Commercial Sections
                            </a>

                            <a href="{{ route('admin.features.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.features.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                                Services
                            </a>

                            <a href="{{ route('admin.testimonials.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Testimonials
                            </a>

                            <a href="{{ route('admin.faqs.index') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors {{ request()->routeIs('admin.faqs.*') ? 'bg-gray-700 text-white' : '' }}">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                FAQs
                            </a>
                        </div>

                        <!-- Dropdown Menu (Expanded State) -->
                        <div x-show="open && !sidebarCollapsed" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" class="dropdown-submenu mt-1">

                            <!-- Hero Sections -->
                            <a href="{{ route('admin.hero-sections.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.hero-sections.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z">
                                    </path>
                                </svg>
                                Hero Sections
                            </a>

                            <!-- About Us -->
                            <a href="{{ route('admin.about-us.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.about-us.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                About Us
                            </a>


                            <!-- Categories -->
                            <a href="{{ route('admin.categories.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.categories.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14-7H3a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zM9 7h1m4 0h1m-5.5 5h1m4 0h1m-5.5 5h1m4 0h1">
                                    </path>
                                </svg>
                                Categories
                            </a>

                            <!-- Cities -->
                            <a href="{{ route('admin.cities.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.cities.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Cities
                            </a>

                            <!-- Commercial Sections -->
                            <a href="{{ route('admin.commercial-sections.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.commercial-sections.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                Commercial Sections
                            </a>


                            <!-- Services -->
                            <a href="{{ route('admin.features.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.features.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                                Services
                            </a>

                            <!-- Testimonials -->
                            <a href="{{ route('admin.testimonials.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                Testimonials
                            </a>

                            <!-- FAQs -->
                            <a href="{{ route('admin.faqs.index') }}"
                                class="admin-sidebar-link flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'active' : 'text-gray-400 hover:text-white' }}">
                                <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                FAQs
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen transition-all duration-300" 
             :class="{ 
                'lg:ml-64': !sidebarCollapsed,
                'lg:ml-20': sidebarCollapsed
             }">
            <!-- Top Header -->
            <header class="admin-header sticky top-0 z-20">
                <div class="px-4 lg:px-6 py-4">
                    <div class="flex justify-between items-center">
                        <!-- Mobile Menu Button & Page Title -->
                        <div class="flex items-center">
                            <button @click="sidebarOpen = !sidebarOpen"
                                class="lg:hidden p-2 rounded-md text-gray-600 hover:text-zendo-navy hover:bg-gray-100 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-xl lg:text-2xl font-heading text-zendo-navy font-semibold"
                                    style="display: none">@yield('page-title', 'Dashboard')</h1>
                                <p class="text-gray-600 text-sm hidden lg:block" style="display: none">
                                    @yield('page-description', 'Welcome to your admin dashboard')
                                </p>
                            </div>
                        </div>
                        <!-- Right side - User menu and notifications -->
                        <div class="flex items-center space-x-3">
                            <!-- Notifications -->
                            <button
                                class="p-2 text-gray-400 hover:text-zendo-navy transition-colors relative rounded-lg hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-5 5v-5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="absolute -top-1 -right-1 block h-3 w-3 rounded-full bg-red-400"></span>
                            </button>
                            <!-- User Profile Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center space-x-2 text-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-zendo-gold p-2 hover:bg-gray-100">
                                    <div class="w-8 h-8 bg-zendo-gold rounded-full flex items-center justify-center">
                                        <span
                                            class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span
                                        class="font-medium text-gray-700 hidden lg:block">{{ Auth::user()->name }}</span>
                                    <svg class="w-4 h-4 text-gray-400 hidden lg:block" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200">
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile
                                        Settings</a>
                                    <a href="{{ route('home') }}" target="_blank"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View
                                        Website</a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main Content -->
            <main class="admin-main-content flex-1 p-4 lg:p-6">
                @yield('content')
            </main>
            <!-- Admin Footer -->
            <footer class="admin-footer">
                <div class="px-4 lg:px-6 py-4">
                    <div
                        class="flex flex-col lg:flex-row justify-between items-center text-sm text-gray-600 space-y-2 lg:space-y-0">
                        <div>
                            <p>&copy; {{ date('Y') }} ZendoIndia. All rights reserved.</p>
                        </div>
                        <div class="flex space-x-6">
                            <a href="#" class="hover:text-zendo-navy transition-colors">Support</a>
                            <a href="#" class="hover:text-zendo-navy transition-colors">Documentation</a>
                            <a href="#" class="hover:text-zendo-navy transition-colors">Privacy Policy</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @yield('scripts')
    <script>
        // Alpine.js cloak
        document.addEventListener('alpine:init', () => {
            // Any Alpine.js initialization code
        });
    </script>
</body>

</html>
