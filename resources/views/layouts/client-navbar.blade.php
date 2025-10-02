<!-- Client Navbar - Diskominfo Government Style -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Font Imports -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>
    :root {
        --default-font: "Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        --heading-font: "Jost", sans-serif;
        --nav-font: "Poppins", sans-serif;
    }

    /* Diskominfo Government Header Style */
    .diskominfo-header {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-height: 80px;
    }

    .diagonal-overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
        clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
    
    .client-logo {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    .client-logo:hover {
        transform: scale(1.05);
    }

    /* Navigation Styles */
    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        color: #ffffff;
        font-weight: 500;
        text-decoration: none;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        font-size: 14px;
        white-space: nowrap;
        opacity: 0.9;
    }

    .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        transform: translateY(-1px);
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .nav-button {
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }
    
    .nav-button:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: white;
    }

    /* Font family applications */
    .default-font {
        font-family: var(--default-font);
        font-size: 16px;
        line-height: 1.6;
    }

    .heading-font {
        font-family: var(--heading-font);
    }

    .nav-font {
        font-family: var(--nav-font);
        font-size: 15px;
        font-weight: 500;
    }
</style>

<!-- Diskominfo Government Header -->
<div class="diskominfo-header text-white">
    <div class="diagonal-overlay"></div>
    <div class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <!-- Left: Logo + Title -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                        alt="Logo Diskominfo Purwakarta"
                        class="client-logo object-contain">
                    
                    <div>
                        <h1 class="text-xl font-bold heading-font text-white leading-tight">DASHBOARD DISKOMINFO PURWAKARTA</h1>
                        <p class="text-blue-100 text-sm default-font">
                            Dinas Komunikasi dan Informatika - Sistem Monitoring & Data OPD
                        </p>
                    </div>
                </div>

                <!-- Center: Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-4 nav-font">
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('health.monitoring') }}" 
                       class="nav-link {{ request()->routeIs('health.monitoring') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Health Monitoring
                    </a>
                    
                    <a href="{{ route('subdomain.status') }}" 
                       class="nav-link {{ request()->routeIs('subdomain.status') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Status Subdomain OPD
                    </a>
                    
                    <a href="{{ route('server.infrastructure') }}" 
                       class="nav-link {{ request()->routeIs('server.infrastructure') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                        Server Infrastructure
                    </a>
                    
                    <a href="{{ route('realtime.monitoring') }}" 
                       class="nav-link {{ request()->routeIs('realtime.monitoring') ? 'active' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Real-time Monitoring
                    </a>
                </div>

                <!-- Right: Profile Menu -->
                <div class="flex items-center space-x-2">
                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="lg:hidden nav-button">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <button id="profileMenuButton" class="nav-button">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="hidden lg:inline">Profile</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                            @auth
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                
                                <a href="{{ route('admin.spreadsheet-links.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" fill="none"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Admin Panel
                                </a>
                                
                                <div class="border-t border-gray-100"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                                
                                <a href="{{ route('register') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 hover:text-green-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden lg:hidden bg-blue-900 bg-opacity-95 border-t border-white border-opacity-20">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('health.monitoring') }}" class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Health Monitoring
            </a>
            <a href="{{ route('subdomain.status') }}" class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                </svg>
                Status Subdomain OPD
            </a>
            <a href="{{ route('server.infrastructure') }}" class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                </svg>
                Server Infrastructure
            </a>
            <a href="{{ route('realtime.monitoring') }}" class="block px-4 py-3 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Real-time Monitoring
            </a>
        </div>
    </div>
</div>

<script>
    // Mobile menu toggle
    document.getElementById('mobileMenuButton').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobileMenu');
        mobileMenu.classList.toggle('hidden');
    });

    // Profile menu toggle
    document.getElementById('profileMenuButton').addEventListener('click', function() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const profileButton = document.getElementById('profileMenuButton');
        const profileDropdown = document.getElementById('profileDropdown');
        const mobileButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        // Close profile dropdown if clicked outside
        if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
        
        // Close mobile menu if clicked outside
        if (!mobileButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
