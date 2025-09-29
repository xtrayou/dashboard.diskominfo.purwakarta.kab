<!-- Client Unified Header - diskominfo  Style -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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

    /* Unified Header - diskominfo  Style */
    .diskominfo-unified-header {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        margin: 0;
        border-radius: 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        min-height: 80px;
    }

    .diskominfo-diagonal-overlay {
        position: absolute;
        top: 0;
        right: 0;
        width: 300px;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
        clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    .unified-logo {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    .unified-logo:hover {
        transform: scale(1.05);
    }

    /* diskominfo Navigation Link Styles */
    .diskominfo-nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        color: #ffffff !important;
        font-weight: 500;
        text-decoration: none;
        border-radius: 0.375rem;
        transition: all 0.2s ease;
        font-size: 13px;
        white-space: nowrap;
        opacity: 0.9;
    }

    .diskominfo-nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        transform: translateY(-1px);
    }

    .diskominfo-nav-active {
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .unified-button {
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
    }

    .unified-button:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .mobile-nav-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: white;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .mobile-nav-item:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .unified-nav-item.active {
        @apply bg-white bg-opacity-20 text-white font-semibold;
    }

    .unified-button {
        @apply px-4 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-white bg-opacity-10 hover:bg-opacity-20 border border-white border-opacity-20;
    }

    /* Font family applications with larger sizes */
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

<!-- diskominfo  Unified Header -->
<div class="diskominfo-unified-header shadow-lg text-white relative">
    <div class="diskominfo-diagonal-overlay"></div>
    <div class="relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <!-- Left: Logo + Title -->
                <div class="flex items-center space-x-4">
                    <img src="<?php echo e(asset('images/logos/logo-diskominfo-purwakarta.jpg')); ?>"
                        alt="Logo Diskominfo Purwakarta"
                        class="unified-logo object-contain">

                    <div>
                        <h1 class="text-xl font-bold heading-font text-white leading-tight">DASHBOARD DATA SUBDOMAIN DAN OPD PURWAKARTA</h1>
                        <p class="text-blue-100 text-sm default-font flex items-center">
                            Dinas Komunikasi dan Informatika
                            <span class="ml-2 bg-blue-600 text-white px-2 py-0.5 rounded text-xs">Purwakarta</span>
                        </p>
                    </div>
                </div>

                <!-- Center: Navigation (inline with header) -->
                <div class="hidden md:flex items-center space-x-4 nav-font">
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="diskominfo-nav-link <?php echo e(request()->routeIs('dashboard') ? 'diskominfo-nav-active' : ''); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <a href="<?php echo e(route('health.monitoring')); ?>"
                        class="diskominfo-nav-link <?php echo e(request()->routeIs('health.monitoring') ? 'diskominfo-nav-active' : ''); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Health Monitoring
                    </a>

                    <a href="<?php echo e(route('subdomain.status')); ?>"
                        class="diskominfo-nav-link <?php echo e(request()->routeIs('subdomain.status') ? 'diskominfo-nav-active' : ''); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                        Status Subdomain OPD
                    </a>

                    <a href="<?php echo e(route('server.infrastructure')); ?>"
                        class="diskominfo-nav-link <?php echo e(request()->routeIs('server.infrastructure') ? 'diskominfo-nav-active' : ''); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                        Server Infrastructure
                    </a>

                    <a href="<?php echo e(route('realtime.monitoring')); ?>"
                        class="diskominfo-nav-link <?php echo e(request()->routeIs('realtime.monitoring') ? 'diskominfo-nav-active' : ''); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Real-time Monitoring
                    </a>
                </div>

                <!-- Right Section: Action Buttons -->
                <div class="flex items-center space-x-2">
                    <?php if (auth()->guard()->check()): ?>
                        <?php if (auth()->user()->role === 'admin' || auth()->user()->email === 'admin@purwakarta.go.id'): ?>
                            <a href="<?php echo e(route('admin.spreadsheet-links.index')); ?>" class="unified-button text-white">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="hidden lg:inline">Administrator</span>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>

                    <button class="unified-button text-white">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span class="hidden lg:inline">Refresh Data</span>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuButton" class="lg:hidden unified-button text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- User Menu -->
                    <div class="relative">
                        <button id="clientUserMenuButton" class="unified-button flex items-center space-x-1 text-white">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="hidden lg:inline"><?php echo e(auth()->user()->name ?? 'Administrator'); ?></span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="clientUserDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-200">
                            <?php if (auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-700 transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Menu -->
<div id="mobileMenu" class="hidden lg:hidden bg-blue-900 bg-opacity-95 border-t border-white border-opacity-20">
    <div class="px-4 py-3 space-y-2">
        <a href="<?php echo e(route('dashboard')); ?>" class="mobile-nav-item">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Dashboard
        </a>
        <a href="<?php echo e(route('health.monitoring')); ?>" class="mobile-nav-item">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Health Monitoring
        </a>
        <a href="<?php echo e(route('subdomain.status')); ?>" class="mobile-nav-item">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
            Status Subdomain OPD
        </a>
        <a href="<?php echo e(route('server.infrastructure')); ?>" class="mobile-nav-item">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
            </svg>
            Server Infrastructure
        </a>
        <a href="<?php echo e(route('realtime.monitoring')); ?>" class="mobile-nav-item">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Monitoring Real-time
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

    // Client user menu dropdown
    document.getElementById('clientUserMenuButton').addEventListener('click', function() {
        const dropdown = document.getElementById('clientUserDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const userButton = document.getElementById('clientUserMenuButton');
        const userDropdown = document.getElementById('clientUserDropdown');
        const mobileButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        // Close user dropdown if clicked outside
        if (!userButton.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
        }

        // Close mobile menu if clicked outside
        if (!mobileButton.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/layouts/client-navbar.blade.php ENDPATH**/ ?>