<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Diskominfo - Kabupaten Purwakarta</title>
    
    <!-- Font Imports -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --default-font: "Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif;
            --heading-font: "Jost", sans-serif;
            --nav-font: "Poppins", sans-serif;
        }
        
        body {
            font-family: var(--default-font);
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #1d4ed8 50%, #2563eb 75%, #3b82f6 100%);
            min-height: 100vh;
        }
        
        .heading-font {
            font-family: var(--heading-font);
        }
        
        .nav-font {
            font-family: var(--nav-font);
        }
        
        .logo-container {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: inline-block;
        }
        
        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        
        .welcome-button {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 12px 32px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            margin: 0 8px;
        }
        
        .welcome-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }
        
        .welcome-button.secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        }
        
        .welcome-button.secondary:hover {
            box-shadow: 0 8px 20px rgba(107, 114, 128, 0.4);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="text-center text-white max-w-4xl mx-auto px-6">
        <!-- Logo Diskominfo -->
        <div class="flex justify-center mb-8">
            <div class="logo-container">
                <img src="<?php echo e(asset('images/logos/logo-diskominfo-purwakarta.svg')); ?>" 
                     alt="Logo Diskominfo Purwakarta" 
                     class="mx-auto">
            </div>
        </div>

        <!-- Main Title -->
        <h1 class="text-5xl font-bold heading-font mb-4">
            Dashboard Diskominfo
        </h1>
        
        <h2 class="text-3xl font-semibold heading-font mb-6 text-blue-100">
            Kabupaten Purwakarta
        </h2>

        <!-- Subtitle -->
        <p class="text-xl mb-2 text-blue-50">
            Sistem Monitoring Subdomain dan Data OPD
        </p>
        <p class="text-lg mb-12 text-blue-100">
            Dinas Komunikasi dan Informatika Kabupaten Purwakarta
        </p>

        <!-- Action Button -->
        <div class="flex justify-center mb-16">
            <a href="<?php echo e(route('dashboard')); ?>" class="welcome-button nav-font">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Lihat
            </a>
            <?php if(auth()->guard()->guest()): ?>
            <a href="<?php echo e(route('register')); ?>" class="welcome-button secondary nav-font">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Register
            </a>
            <?php endif; ?>
        </div>

        <!-- Footer -->
        <div class="text-center text-blue-100">
            <p>&copy; <?php echo e(date('Y')); ?> Dinas Komunikasi dan Informatika Kabupaten Purwakarta</p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/welcome.blade.php ENDPATH**/ ?>