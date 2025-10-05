<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Diskominfo Purwakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>

<body class="hero-bg min-h-screen flex items-center justify-center">
    <div class="text-center text-white px-4">
        <!-- Logo -->
        <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
            alt="Logo Diskominfo Purwakarta" class="w-32 h-32 mx-auto mb-8 rounded-lg">

        <!-- Title -->
        <h1 class="text-4xl md:text-6xl font-bold mb-4">
            Dashboard Diskominfo
        </h1>
        <h2 class="text-xl md:text-2xl font-medium mb-8">
            Kabupaten Purwakarta
        </h2>

        <!-- Description -->
        <p class="text-lg md:text-xl text-blue-100 mb-12 max-w-2xl mx-auto">
            Sistem Monitoring Subdomain dan Data OPD<br>
            Dinas Komunikasi dan Informatika Kabupaten Purwakarta
        </p>

        <!-- Actions -->
        <div class="space-y-4 md:space-y-0 md:space-x-4 md:flex md:justify-center">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Masuk ke Dashboard
            </a>
            @else
            <a href="{{ route('login') }}"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 mr-4">
                Login
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                Register
            </a>
            @endif
            @endauth
        </div>

        <!-- Footer -->
        <div class="mt-16 text-blue-100">
            <p>© 2025 Dinas Komunikasi dan Informatika Kabupaten Purwakarta</p>
        </div>
    </div>
</body>

</html>