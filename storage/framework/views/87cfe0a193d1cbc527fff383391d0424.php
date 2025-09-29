<!-- Header -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white p-6 rounded-lg m-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Lambang_Kabupaten_Purwakarta.svg/200px-Lambang_Kabupaten_Purwakarta.svg.png"
                alt="Logo Diskominfo" class="w-12 h-12">
            <div>
                <h1 class="text-2xl font-bold">DASHBOARD DATA SUBDOMAIN DAN OPD PURWAKARTA</h1>
                <p class="text-blue-100">Dinas Komunikasi dan Informatika</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <button class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-colors">
                Refresh Data
            </button>
            <!-- User Menu -->
            <div class="relative">
                <button id="userMenuButton" class="flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-colors">
                    <span><?php echo e(auth()->user()->name); ?></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="block">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bar -->
<div class="bg-white shadow-md mx-4 rounded-lg mb-4">
    <nav class="px-6 py-4">
        <ul class="flex space-x-8 text-sm font-medium">
            <li>
                <a href="<?php echo e(route('dashboard')); ?>"
                    class="flex items-center space-x-2 <?php echo e(request()->routeIs('dashboard') ? 'text-blue-600 border-b-2 border-blue-600 pb-2' : 'text-gray-600 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('health.monitoring')); ?>"
                    class="flex items-center space-x-2 <?php echo e(request()->routeIs('health.monitoring') ? 'text-blue-600 border-b-2 border-blue-600 pb-2' : 'text-gray-600 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Health Domain Monitoring</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('subdomain.status')); ?>"
                    class="flex items-center space-x-2 <?php echo e(request()->routeIs('subdomain.status') ? 'text-blue-600 border-b-2 border-blue-600 pb-2' : 'text-gray-600 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <span>Status Aktivasi Subdomain OPD</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('server.infrastructure')); ?>"
                    class="flex items-center space-x-2 <?php echo e(request()->routeIs('server.infrastructure') ? 'text-blue-600 border-b-2 border-blue-600 pb-2' : 'text-gray-600 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                    </svg>
                    <span>Server Infrastructure Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('realtime.monitoring')); ?>"
                    class="flex items-center space-x-2 <?php echo e(request()->routeIs('realtime.monitoring') ? 'text-blue-600 border-b-2 border-blue-600 pb-2' : 'text-gray-600 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Monitoring & Analisis Real-time</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script>
    // User dropdown menu
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');

        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function() {
                userDropdown.classList.toggle('hidden');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    });
</script><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>