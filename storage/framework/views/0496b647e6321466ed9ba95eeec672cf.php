<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Infrastructure Dashboard - Dashboard Diskominfo Purwakarta</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-green {
            background: linear-gradient(135deg, #4caf50, #388e3c);
        }

        .card-red {
            background: linear-gradient(135deg, #f44336, #d32f2f);
        }

        .card-blue {
            background: linear-gradient(135deg, #2196f3, #1976d2);
        }

        .card-orange {
            background: linear-gradient(135deg, #ff9500, #ff7b00);
        }

        .card-purple {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
        }

        .card-teal {
            background: linear-gradient(135deg, #009688, #00695c);
        }

        .progress-ring {
            transform: rotate(-90deg);
        }
    </style>
</head>

<body class="min-h-screen"
    style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Server Infrastructure Dashboard</h2>
            <p class="text-gray-600">Monitoring infrastruktur server dan resource utilization secara real-time</p>
        </div>

        <!-- Server Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="card-green text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">ONLINE SERVERS</h3>
                <p class="text-3xl font-bold"><?php echo e($serverStats['online_servers']); ?>/<?php echo e($serverStats['total_servers']); ?></p>
            </div>
            <div class="card-red text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">OFFLINE SERVERS</h3>
                <p class="text-3xl font-bold"><?php echo e($serverStats['offline_servers']); ?></p>
            </div>
            <div class="card-blue text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">NETWORK TRAFFIC</h3>
                <p class="text-3xl font-bold"><?php echo e($serverStats['network_traffic']); ?></p>
            </div>
        </div>

        <!-- Resource Utilization -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">CPU Usage</h3>
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <svg class="w-32 h-32 progress-ring">
                        <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="8" fill="transparent" />
                        <circle cx="64" cy="64" r="56" stroke="#3b82f6" stroke-width="8" fill="transparent"
                            stroke-dasharray="351.86" stroke-dashoffset="<?php echo e(351.86 - (351.86 * $serverStats['cpu_usage'] / 100)); ?>"
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-800"><?php echo e($serverStats['cpu_usage']); ?>%</span>
                    </div>
                </div>
                <p class="text-gray-600">Average CPU utilization</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Memory Usage</h3>
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <svg class="w-32 h-32 progress-ring">
                        <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="8" fill="transparent" />
                        <circle cx="64" cy="64" r="56" stroke="#10b981" stroke-width="8" fill="transparent"
                            stroke-dasharray="351.86" stroke-dashoffset="<?php echo e(351.86 - (351.86 * $serverStats['memory_usage'] / 100)); ?>"
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-800"><?php echo e($serverStats['memory_usage']); ?>%</span>
                    </div>
                </div>
                <p class="text-gray-600">Average Memory utilization</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Disk Usage</h3>
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <svg class="w-32 h-32 progress-ring">
                        <circle cx="64" cy="64" r="56" stroke="#e5e7eb" stroke-width="8" fill="transparent" />
                        <circle cx="64" cy="64" r="56" stroke="#f59e0b" stroke-width="8" fill="transparent"
                            stroke-dasharray="351.86" stroke-dashoffset="<?php echo e(351.86 - (351.86 * $serverStats['disk_usage'] / 100)); ?>"
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-800"><?php echo e($serverStats['disk_usage']); ?>%</span>
                    </div>
                </div>
                <p class="text-gray-600">Average Disk utilization</p>
            </div>
        </div>

        <!-- Server List -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Server Status & Performance</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Server Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">CPU</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Memory</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Uptime</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 rounded-full mr-3 <?php echo e($server['status'] === 'Online' ? 'bg-green-500' : 'bg-red-500'); ?>"></div>
                                    <div class="text-sm font-medium text-gray-900"><?php echo e($server['name']); ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo e($server['ip']); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    <?php echo e($server['status'] === 'Online' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                    <?php echo e($server['status']); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900"><?php echo e($server['cpu']); ?>%</div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-blue-500 h-1.5 rounded-full" style="width: <?php echo e($server['cpu']); ?>%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-gray-900"><?php echo e($server['memory']); ?>%</div>
                                <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                    <div class="bg-green-500 h-1.5 rounded-full" style="width: <?php echo e($server['memory']); ?>%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                <?php echo e($server['status'] === 'Online' ? rand(1, 30) . ' days' : 'N/A'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <?php if($server['status'] === 'Online'): ?>
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Monitor</button>
                                <button class="text-yellow-600 hover:text-yellow-900">Restart</button>
                                <?php else: ?>
                                <button class="text-green-600 hover:text-green-900 mr-3">Start</button>
                                <button class="text-gray-600 hover:text-gray-900">Debug</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Performance Chart -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Server Performance Trends (Last 24 Hours)</h3>
            <div style="height: 300px;">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00', '24:00'],
                datasets: [{
                    label: 'CPU Usage (%)',
                    data: [25, 30, 45, 60, 55, 40, 35],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true
                }, {
                    label: 'Memory Usage (%)',
                    data: [40, 42, 48, 55, 52, 45, 43],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true
                }, {
                    label: 'Disk Usage (%)',
                    data: [65, 66, 67, 68, 69, 70, 71],
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Auto-refresh every 60 seconds
        setInterval(function() {
            location.reload();
        }, 60000);
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/pages/monitoring/server-infrastructure.blade.php ENDPATH**/ ?>