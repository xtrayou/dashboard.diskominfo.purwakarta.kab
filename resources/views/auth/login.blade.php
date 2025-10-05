<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Diskominfo Purwakarta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Noto Sans', Helvetica, Arial, sans-serif;
        }

        .login-bg {
            background: linear-gradient(-45deg, #1a1a2e, #16213e, #0f3460, #e94560);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="login-bg min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo dan Header -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logos/logo-diskominfo-purwakarta.jpg') }}"
                alt="Logo Diskominfo Purwakarta" class="w-20 h-20 mx-auto mb-4 rounded-2xl shadow-2xl">
            <h1 class="text-white text-2xl font-bold mb-2">Dashboard Diskominfo</h1>
            <p class="text-gray-200">Kabupaten Purwakarta</p>
        </div>

        <!-- Login Form -->
        <div class="glass-form rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Masuk ke Dashboard</h2>

            <!-- Session Status -->
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                        Lupa password?
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Masuk
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Demo Login:</h3>
                <div class="text-xs text-gray-600 space-y-1">
                    <p><strong>Email:</strong> admin@diskominfo.go.id</p>
                    <p><strong>Password:</strong> password123</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-blue-100 text-sm">
                © 2025 Dinas Komunikasi dan Informatika<br>
                Kabupaten Purwakarta
            </p>
        </div>
    </div>
</body>

</html>