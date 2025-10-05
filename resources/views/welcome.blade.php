<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring - Diskominfo Purwakarta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Welcome Page Styles */
        body {
            margin: 0;
            padding: 0;
        }

        .welcome-bg {
            background-image: url('{{ asset("images/bg-welcomepage.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .hero-pattern {
            background: rgba(0, 0, 0, 0.4); /* Dark overlay untuk readability */
        }

        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .slide-in {
            animation: slideIn 1s ease-out;
        }

        .stats-counter {
            animation: countUp 1.5s ease-out forwards;
        }

        /* Text shadow for better readability */
        .text-with-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .hero-content {
            backdrop-filter: blur(1px);
            background: rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 2rem;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.05);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover effects */
        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        /* Desktop optimized styles */
        @media (min-width: 1024px) {
            .welcome-bg {
                background-size: cover;
                min-height: 100vh;
            }
            
            .hero-pattern {
                background: rgba(0, 0, 0, 0.3); /* Lighter overlay on desktop */
            }
        }

        /* Responsive typography */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
                line-height: 1.2;
            }
            
            .welcome-bg {
                background-attachment: scroll; /* Better performance on mobile */
            }
        }
    </style>
</head>

<body class="antialiased welcome-bg">
    <!-- Hero Section -->
    <div class="min-h-screen hero-pattern relative overflow-hidden">
        <!-- Background Elements - Subtle decorative elements -->
        <div class="absolute inset-0 z-10">
            <div class="absolute top-10 left-10 w-16 h-16 bg-white bg-opacity-10 rounded-full pulse-animation"></div>
            <div class="absolute top-40 right-20 w-12 h-12 bg-yellow-400 bg-opacity-20 rounded-full pulse-animation" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 left-20 w-20 h-20 bg-white bg-opacity-5 rounded-full pulse-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 right-10 w-10 h-10 bg-blue-300 bg-opacity-15 rounded-full pulse-animation" style="animation-delay: 1.5s;"></div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-20 px-6 py-4">
            <div class="container mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}" alt="Logo Diskominfo" class="h-12 w-12 rounded-lg shadow-lg">
                    <div>
                        <h1 class="text-white font-bold text-xl">Diskominfo Purwakarta</h1>
                        <p class="text-blue-100 text-sm">Dashboard Monitoring System</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <a href="{{ route('dashboard') }}" class="bg-white hover:bg-gray-100 text-blue-900 px-6 py-2 rounded-lg transition-colors font-medium">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-200 transition-colors px-4 py-2">Masuk</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 px-6 py-2 rounded-lg transition-colors font-medium">Daftar</a>
                    @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="relative z-20 container mx-auto px-6 py-16">
            <div class="text-center slide-in">
                <!-- Hero Title -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 font-sans tracking-tight text-with-shadow">
                    Dashboard
                    <span class="text-yellow-400 drop-shadow-lg">
                        Monitoring
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white mb-4 max-w-3xl mx-auto leading-relaxed font-medium text-with-shadow">
                    Sistem monitoring real-time untuk infrastruktur digital
                    <span class="font-bold text-yellow-300 drop-shadow-md">Kabupaten Purwakarta</span>
                </p>

                <p class="text-lg text-blue-100 mb-12 max-w-2xl mx-auto font-normal leading-relaxed text-with-shadow">
                    Pantau kesehatan sistem, status subdomain, dan performa server dalam satu dashboard terintegrasi
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center bg-white hover:bg-gray-100 text-blue-900 px-10 py-4 rounded-xl transition-all duration-300 font-bold text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 space-x-3 min-w-[200px]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Lihat Dashboard</span>
                    </a>
                    <a href="#footer" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 rounded-xl transition-all duration-300 font-bold text-lg min-w-[200px]">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="stats-counter text-3xl md:text-4xl font-bold text-yellow-400 mb-2">24/7</div>
                        <p class="text-blue-100">Monitoring</p>
                    </div>
                    <div class="text-center">
                        <div class="stats-counter text-3xl md:text-4xl font-bold text-yellow-400 mb-2">100+</div>
                        <p class="text-blue-100">Subdomain</p>
                    </div>
                    <div class="text-center">
                        <div class="stats-counter text-3xl md:text-4xl font-bold text-yellow-400 mb-2">99.9%</div>
                        <p class="text-blue-100">Uptime</p>
                    </div>
                    <div class="text-center">
                        <div class="stats-counter text-3xl md:text-4xl font-bold text-yellow-400 mb-2">Real-time</div>
                        <p class="text-blue-100">Updates</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>

    <!-- Enhanced Footer with Features -->

    <!-- Footer -->
    <footer id="footer" class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">
        <div class="container mx-auto px-6 py-16">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

                <!-- Brand Section -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-4 mb-6">
                        <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}" alt="Logo Diskominfo" class="h-16 w-16 rounded-xl shadow-lg">
                        <div>
                            <h3 class="text-2xl font-bold text-white">Diskominfo Purwakarta</h3>
                            <p class="text-blue-300 font-medium">Dashboard Monitoring System</p>
                        </div>
                    </div>
                    <p class="text-gray-300 leading-relaxed mb-6 max-w-md">
                        Sistem monitoring infrastruktur digital terpadu untuk memantau kesehatan website, domain, dan subdomain seluruh OPD di Kabupaten Purwakarta secara real-time dengan teknologi modern dan interface yang user-friendly.
                    </p>
                    <div class="flex space-x-4">
                        <div class="bg-blue-600 bg-opacity-20 px-4 py-2 rounded-lg">
                            <span class="text-blue-300 text-sm font-medium">ðŸ• 24/7 Monitoring</span>
                        </div>
                        <div class="bg-green-600 bg-opacity-20 px-4 py-2 rounded-lg">
                            <span class="text-green-300 text-sm font-medium">âœ“ Real-time Updates</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 border-b border-gray-700 pb-2">Menu Utama</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 flex items-center space-x-2"><span>ðŸ“Š</span><span>Dashboard</span></a></li>
                        <li><a href="{{ route('health.monitoring') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 flex items-center space-x-2"><span>ðŸ’š</span><span>Health Monitoring</span></a></li>
                        <li><a href="{{ route('subdomain.status') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 flex items-center space-x-2"><span>ðŸŒ</span><span>Status Subdomain</span></a></li>
                        <li><a href="{{ route('server.infrastructure') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 flex items-center space-x-2"><span>ðŸ–¥ï¸</span><span>Server Infrastructure</span></a></li>
                        <li><a href="{{ route('realtime.monitoring') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 flex items-center space-x-2"><span>âš¡</span><span>Real-time Monitoring</span></a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6 border-b border-gray-700 pb-2">Informasi Kontak</h4>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-400 mt-1">ðŸ¢</span>
                            <div>
                                <p class="text-gray-300 text-sm">Dinas Komunikasi dan Informatika</p>
                                <p class="text-gray-400 text-sm">Kabupaten Purwakarta</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="text-blue-400 mt-1">ðŸ“</span>
                            <div>
                                <p class="text-gray-300 text-sm">Jl. Gandanegara No.25</p>
                                <p class="text-gray-400 text-sm">Purwakarta, Jawa Barat</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-blue-400">ðŸ“§</span>
                            <p class="text-gray-300 text-sm">diskominfo@purwakartakab.go.id</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="text-blue-400">ðŸŒ</span>
                            <p class="text-gray-300 text-sm">purwakartakab.go.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="border-t border-gray-700 pt-8 mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="text-2xl font-bold text-blue-400">50+</div>
                        <div class="text-gray-400 text-sm">OPD Terpantau</div>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="text-2xl font-bold text-green-400">99.9%</div>
                        <div class="text-gray-400 text-sm">Uptime</div>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="text-2xl font-bold text-yellow-400">24/7</div>
                        <div class="text-gray-400 text-sm">Monitoring</div>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="text-2xl font-bold text-purple-400">Real-time</div>
                        <div class="text-gray-400 text-sm">Updates</div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-center md:text-left mb-4 md:mb-0">
                        <p class="text-gray-400">
                            &copy; {{ date('Y') }} Diskominfo Kabupaten Purwakarta. All rights reserved.
                        </p>
                        <p class="text-gray-500 text-sm mt-1">
                            Sistem Monitoring Infrastruktur Digital Pemerintah Kabupaten Purwakarta
                        </p>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-green-400 text-sm font-medium">System Online</span>
                        </div>
                        <div class="text-gray-400 text-sm">
                            Last Updated: {{ date('d M Y, H:i') }} WIB
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
