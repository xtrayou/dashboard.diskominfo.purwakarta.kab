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
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Lambang_Kabupaten_Purwakarta.svg/200px-Lambang_Kabupaten_Purwakarta.svg.png"
            alt="Logo Purwakarta" class="w-32 h-32 mx-auto mb-8">

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
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(url('/dashboard')); ?>"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200">
                Masuk ke Dashboard
            </a>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>"
                class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-200 mr-4">
                Login
            </a>
            <?php if(Route::has('register')): ?>
            <a href="<?php echo e(route('register')); ?>"
                class="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                Register
            </a>
            <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="mt-16 text-blue-100">
            <p>© 2025 Dinas Komunikasi dan Informatika Kabupaten Purwakarta</p>
        </div>
    </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/welcome.blade.php ENDPATH**/ ?>