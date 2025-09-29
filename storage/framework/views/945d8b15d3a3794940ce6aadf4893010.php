<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        
        <!-- Global Font Styles -->
        <style>
            :root {
                --default-font: "Open Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                --heading-font: "Jost", sans-serif;
                --nav-font: "Poppins", sans-serif;
            }

            /* Font family applications with larger sizes */
            .default-font, body {
                font-family: var(--default-font);
                font-size: 16px; /* Increased from default 14px */
                line-height: 1.6;
            }

            .heading-font, h1, h2, h3, h4, h5, h6 {
                font-family: var(--heading-font);
            }

            .nav-font {
                font-family: var(--nav-font);
                font-size: 15px; /* Increased navigation font size */
            }

            /* Larger heading sizes */
            h1 { font-size: 2.5rem; font-weight: 700; }
            h2 { font-size: 2rem; font-weight: 600; }
            h3 { font-size: 1.75rem; font-weight: 600; }
            h4 { font-size: 1.5rem; font-weight: 500; }
            h5 { font-size: 1.25rem; font-weight: 500; }
            h6 { font-size: 1.125rem; font-weight: 500; }

            /* Larger text sizes for various elements */
            p { font-size: 16px; line-height: 1.6; }
            .text-sm { font-size: 15px !important; }
            .text-xs { font-size: 13px !important; }
            .text-lg { font-size: 19px !important; }
            .text-xl { font-size: 22px !important; }
            .text-2xl { font-size: 26px !important; }
        </style>
    </head>
    <body class="default-font antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Conditional Navigation based on route -->
            <?php if(request()->routeIs('admin.*')): ?>
                <?php echo $__env->make('layouts.admin-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.client-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/layouts/app.blade.php ENDPATH**/ ?>