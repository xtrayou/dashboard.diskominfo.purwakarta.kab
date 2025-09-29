<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Subdomain dan OPD Purwakarta</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-orange {
            background: linear-gradient(135deg, #ff9500, #ff7b00);
        }

        .card-green {
            background: linear-gradient(135deg, #4caf50, #388e3c);
        }

        .card-red {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .card-blue {
            background: linear-gradient(135deg, #2196f3, #1976d2);
        }

        .chart-container {
            height: 300px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
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
                        class="flex items-center space-x-2 text-blue-600 border-b-2 border-blue-600 pb-2 <?php echo e(request()->routeIs('dashboard') ? 'active' : 'text-gray-600 hover:text-blue-600'); ?>">
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

    <div class="container mx-auto px-4">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card-orange text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">SUBDOMAIN SAMA</h3>
                <p class="text-3xl font-bold"><?php echo e($stats['subdomain_sama']); ?></p>
            </div>
            <div class="card-green text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">AKTIF</h3>
                <p class="text-3xl font-bold"><?php echo e($stats['aktif']); ?></p>
            </div>
            <div class="card-red text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">TIDAK AKTIF</h3>
                <p class="text-3xl font-bold"><?php echo e($stats['tidak_aktif']); ?></p>
            </div>
            <div class="card-blue text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">KATEGORI DOMAIN</h3>
                <p class="text-3xl font-bold"><?php echo e($stats['kategori_domain']); ?></p>
            </div>
        </div>

        <!-- Dropdown Filter -->
        <div class="mb-6">
            <select class="bg-blue-100 border border-blue-200 rounded px-4 py-2">
                <option>Subdomain Aktif</option>
                <option>Subdomain Tidak Aktif</option>
            </select>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- IP Address Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Jumlah Ip Subdomain yang sama menurut IP ADDRESS</h3>
                <div class="chart-container">
                    <canvas id="ipChart"></canvas>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Distribusi Subdomain Berdasarkan Status</h3>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Category Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">KATEGORI</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left p-2">Source</th>
                                <th class="text-left p-2">Status</th>
                                <th class="text-left p-2">Record...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categoryData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t">
                                <td class="p-2"><?php echo e($item['source']); ?></td>
                                <td class="p-2">
                                    <span class="inline-block w-3 h-3 rounded-full mr-2 
                                        <?php echo e($item['status'] === 'AKTIF' ? 'bg-green-500' : 'bg-red-500'); ?>"></span>
                                    <?php echo e($item['status']); ?>

                                </td>
                                <td class="p-2"><?php echo e($item['record']); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pie Charts -->
            <div class="space-y-6">
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-sm font-semibold mb-2 text-blue-600">PERSENTASE STATUS</h3>
                    <div style="height: 150px;">
                        <canvas id="statusPieChart"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-lg">
                    <h3 class="text-sm font-semibold mb-2 text-blue-600">PERSENTASE DOMAIN</h3>
                    <div style="height: 150px;">
                        <canvas id="domainPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- IP Address Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">IP ADDRESS</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-left p-2">IP</th>
                                <th class="text-center p-2">Aktif</th>
                                <th class="text-center p-2">Tidak Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $ipAddressData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t <?php echo e($index % 2 === 0 ? 'bg-gray-50' : ''); ?>">
                                <td class="p-2"><?php echo e($item['ip']); ?></td>
                                <td class="text-center p-2"><?php echo e($item['aktif']); ?></td>
                                <td class="text-center p-2"><?php echo e($item['tidak_aktif']); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="text-right text-xs text-gray-500 mt-2">1 - 40 / 40</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // IP Address Bar Chart
        const ipCtx = document.getElementById('ipChart').getContext('2d');
        new Chart(ipCtx, {
            type: 'bar',
            data: {
                labels: {
                    !!json_encode(array_keys($ipAddressChart)) !!
                },
                datasets: [{
                    label: 'Jumlah Ip Subdomain yang sama',
                    data: {
                        !!json_encode(array_values($ipAddressChart)) !!
                    },
                    backgroundColor: '#ff9500',
                    borderColor: '#ff7b00',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 400
                    },
                    x: {
                        ticks: {
                            maxRotation: 45
                        }
                    }
                }
            }
        });

        // Status Distribution Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($statusByOpdChart - > pluck('nama_opd'), 15, 512) ?>,
                datasets: [{
                    label: 'Aktif',
                    data: <?php echo json_encode($statusByOpdChart - > pluck('aktif'), 15, 512) ?>,
                    backgroundColor: '#4caf50'
                }, {
                    label: 'Tidak Aktif',
                    data: <?php echo json_encode($statusByOpdChart - > pluck('tidak_aktif'), 15, 512) ?>,
                    backgroundColor: '#f44336'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 2
                    },
                    x: {
                        ticks: {
                            maxRotation: 45,
                            font: {
                                size: 10
                            }
                        }
                    }
                }
            }
        });

        // Status Pie Chart
        const statusPieCtx = document.getElementById('statusPieChart').getContext('2d');
        new Chart(statusPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tidak Aktif', 'Aktif'],
                datasets: [{
                    data: [{
                        {
                            $statusDistribution['tidak_aktif']
                        }
                    }, {
                        {
                            $statusDistribution['aktif']
                        }
                    }],
                    backgroundColor: ['#f44336', '#4caf50'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Domain Pie Chart
        const domainPieCtx = document.getElementById('domainPieChart').getContext('2d');
        new Chart(domainPieCtx, {
            type: 'doughnut',
            data: {
                labels: ['Tidak Aktif', 'Aktif', 'Local'],
                datasets: [{
                    data: [{
                        {
                            $domainDistribution['tidak_aktif']
                        }
                    }, {
                        {
                            $domainDistribution['aktif']
                        }
                    }, {
                        {
                            $domainDistribution['local']
                        }
                    }],
                    backgroundColor: ['#f44336', '#4caf50', '#2196f3'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // User dropdown menu
        document.getElementById('userMenuButton').addEventListener('click', function() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenuButton');
            const dropdown = document.getElementById('userDropdown');

            if (!userMenu.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/dashboard.blade.php ENDPATH**/ ?>