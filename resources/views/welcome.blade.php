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
        .gradient-bg {
            background: linear-gradient(rgba(30, 64, 175, 0.8), rgba(59, 130, 246, 0.8)), url('{{ asset("images/bg-welcomepage.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .slide-in {
            animation: slideIn 0.8s ease-out;
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

        body {
            font-family: 'Inter', 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif;
            font-display: swap;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .hero-pattern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            z-index: 1;
        }

        .stats-counter {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced text visibility */
        h1,
        h2,
        h3 {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .text-shadow {
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        /* Better button styles */
        .btn-primary {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="antialiased">
    <!-- Hero Section -->
    <div class="min-h-screen gradient-bg hero-pattern relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-10">
            <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-15 rounded-full pulse-animation"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-yellow-400 bg-opacity-25 rounded-full pulse-animation" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-20 left-20 w-24 h-24 bg-white bg-opacity-10 rounded-full pulse-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 right-10 w-12 h-12 bg-blue-300 bg-opacity-25 rounded-full pulse-animation" style="animation-delay: 1.5s;"></div>
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
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 font-sans tracking-tight">
                    Dashboard
                    <span class="text-yellow-400 drop-shadow-lg">
                        Monitoring
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-white mb-4 max-w-3xl mx-auto leading-relaxed font-medium">
                    Sistem monitoring real-time untuk infrastruktur digital
                    <span class="font-bold text-yellow-300 drop-shadow-md">Kabupaten Purwakarta</span>
                </p>

                <p class="text-lg text-blue-100 mb-12 max-w-2xl mx-auto font-normal leading-relaxed">
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
                    <a href="#features" class="inline-flex items-center justify-center border-2 border-white text-white hover:bg-white hover:text-blue-900 px-10 py-4 rounded-xl transition-all duration-300 font-bold text-lg min-w-[200px]">
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

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Utama</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dashboard monitoring komprehensif dengan berbagai fitur canggih untuk memantau infrastruktur digital
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Health Monitoring -->
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Health Monitoring</h3>
                    <p class="text-gray-600">Pantau kesehatan sistem secara real-time dengan notifikasi otomatis</p>
                </div>

                <!-- Subdomain Status -->
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Status Subdomain</h3>
                    <p class="text-gray-600">Monitoring status dan performa semua subdomain dalam satu tampilan</p>
                </div>

                <!-- Server Infrastructure -->
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Infrastruktur Server</h3>
                    <p class="text-gray-600">Informasi lengkap tentang kapasitas dan performa server</p>
                </div>

                <!-- Realtime Monitoring -->
                <div class="bg-white rounded-xl p-6 shadow-lg card-hover">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Monitoring Real-time</h3>
                    <p class="text-gray-600">Data real-time dengan update otomatis setiap detik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}" alt="Logo Diskominfo" class="h-10 w-10 rounded-lg">
                    <div>
                        <h3 class="font-semibold">Diskominfo Purwakarta</h3>
                        <p class="text-gray-400 text-sm">Dashboard Monitoring System</p>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-gray-400">&copy; {{ date('Y') }} Diskominfo Kabupaten Purwakarta. All rights reserved.</p>
                    <p class="text-gray-400 text-sm mt-1">Sistem Monitoring Infrastruktur Digital</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add loading animation
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stats counters
            const counters = document.querySelectorAll('.stats-counter');
            counters.forEach(counter => {
                counter.style.opacity = '0';
                setTimeout(() => {
                    counter.style.transition = 'opacity 0.8s ease';
                    counter.style.opacity = '1';
                }, 500);
            });
        });
    </script>
</body>

</html>
<div class="text-blue-100">Total OPD</div>
</div>
<div class="text-center">
    <div class="text-3xl font-bold">0</div>
    <div class="text-blue-100">Total Domain</div>
</div>
<div class="text-center">
    <div class="text-3xl font-bold">0</div>
    <div class="text-blue-100">Domain Aktif</div>
</div>
<div class="text-center">
    <div class="text-3xl font-bold">0</div>
    <div class="text-blue-100">Tidak Aktif</div>
</div>
</div>
</div>

<!-- CTA Buttons -->
<div class="flex justify-center space-x-4">
    @auth
    <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
        Lihat Dashboard
    </a>
    @else
    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
        Login
    </a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 font-bold py-3 px-6 rounded-lg border-2 border-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
        Daftar
    </a>
    @endif
    @endauth
</div>
</div>
</div>
</div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-8">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-gray-400">
            &copy; {{ date('Y') }} Dashboard OPD Purwakarta.
            <span class="text-blue-400">Dinas Komunikasi dan Informatika</span>
        </p>
        <p class="text-gray-500 text-sm mt-2">
            Sistem Monitoring Domain dan Subdomain OPD Kabupaten Purwakarta
        </p>
    </div>
</footer>
</body>

</html>