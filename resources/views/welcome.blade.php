{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard OPD Purwakarta</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <div class="text-center">
                    <!-- Logo/Icon -->
                    <div class="flex justify-center mb-8">
                        <div class="bg-blue-600 p-8 rounded-full shadow-lg">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        Dashboard OPD Purwakarta
                    </h1>
                    <p class="text-xl text-gray-600 mb-8">
                        Sistem Monitoring Subdomain dan Domain OPD<br>
                        <span class="text-blue-600 font-semibold">Dinas Komunikasi dan Informatika</span>
                    </p>

                    <!-- Features -->
                    <div class="grid md:grid-cols-3 gap-6 my-12">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Dashboard Analytics</h3>
                            <p class="text-gray-600 text-sm">Monitoring real-time status domain dan subdomain semua OPD Purwakarta</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Upload Data</h3>
                            <p class="text-gray-600 text-sm">Import data bulk menggunakan file Excel dengan format yang mudah</p>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Role Management</h3>
                            <p class="text-gray-600 text-sm">Sistem role admin dan user dengan akses yang sesuai kebutuhan</p>
                        </div>
                    </div>

                    <!-- Statistics Preview -->
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-8 text-white mb-8">
                        <h2 class="text-2xl font-bold mb-6">Statistik Terkini</h2>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold">0</div>
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