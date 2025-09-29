<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring & Analisis Real-time - Dashboard Diskominfo Purwakarta</title>
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

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        .live-indicator {
            position: relative;
            padding-left: 20px;
        }

        .live-indicator::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
    </style>
</head>

<body class="bg-gray-100">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4">
        <!-- Page Title -->
        <div class="mb-8">
            <div class="flex items-center space-x-4">
                <h2 class="text-3xl font-bold text-gray-800">Monitoring & Analisis Real-time</h2>
                <span class="live-indicator text-sm font-medium text-red-600">LIVE</span>
            </div>
            <p class="text-gray-600">Monitoring sistem dan aktivitas pengguna secara real-time dengan update otomatis</p>
        </div>

        <!-- Real-time Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            <div class="card-blue text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">ACTIVE USERS</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['active_users']); ?></p>
            </div>
            <div class="card-green text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">REQUESTS/MIN</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['requests_per_minute']); ?></p>
            </div>
            <div class="card-orange text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">AVG RESPONSE</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['avg_response_time']); ?></p>
            </div>
            <div class="card-red text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">ERROR RATE</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['error_rate']); ?></p>
            </div>
            <div class="card-purple text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">BANDWIDTH</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['bandwidth_usage']); ?></p>
            </div>
            <div class="card-teal text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">CONNECTIONS</h3>
                <p class="text-2xl font-bold"><?php echo e($realtimeStats['concurrent_connections']); ?></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Real-time Traffic Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Real-time Traffic</h3>
                <div style="height: 250px;">
                    <canvas id="trafficChart"></canvas>
                </div>
            </div>

            <!-- Response Time Chart -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Response Time Trends</h3>
                <div style="height: 250px;">
                    <canvas id="responseTimeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Activity and Alerts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Activities</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <?php $__currentLoopData = $recentActivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900"><?php echo e($activity['event']); ?></p>
                                    <span class="text-xs text-gray-500"><?php echo e($activity['time']); ?></span>
                                </div>
                                <p class="text-sm text-gray-600"><?php echo e($activity['details']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- System Alerts -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">System Alerts</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <?php $__currentLoopData = $systemAlerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-start space-x-3 p-3 rounded-lg
                            <?php echo e($alert['level'] === 'error' ? 'bg-red-50 border-l-4 border-red-400' : 
                               ($alert['level'] === 'warning' ? 'bg-yellow-50 border-l-4 border-yellow-400' : 
                                'bg-blue-50 border-l-4 border-blue-400')); ?>">
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <?php if($alert['level'] === 'error'): ?>
                                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <?php elseif($alert['level'] === 'warning'): ?>
                                        <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <?php else: ?>
                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        <?php endif; ?>
                                        <span class="text-sm font-medium capitalize
                                            <?php echo e($alert['level'] === 'error' ? 'text-red-800' : 
                                               ($alert['level'] === 'warning' ? 'text-yellow-800' : 'text-blue-800')); ?>">
                                            <?php echo e($alert['level']); ?>

                                        </span>
                                    </div>
                                    <span class="text-xs text-gray-500"><?php echo e($alert['time']); ?></span>
                                </div>
                                <p class="text-sm text-gray-700 mt-1"><?php echo e($alert['message']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Status Indicators -->
        <div class="mt-8 text-center">
            <div class="inline-flex items-center space-x-6 px-6 py-3 bg-white rounded-lg shadow">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full pulse"></div>
                    <span class="text-sm text-gray-700">System Online</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-blue-500 rounded-full pulse"></div>
                    <span class="text-sm text-gray-700">Auto-refresh: 5s</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full pulse"></div>
                    <span class="text-sm text-gray-700">Last update: <span id="lastUpdate"><?php echo e(now()->format('H:i:s')); ?></span></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Traffic Chart
        const trafficCtx = document.getElementById('trafficChart').getContext('2d');
        const trafficChart = new Chart(trafficCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Requests',
                    data: [],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Response Time Chart
        const responseCtx = document.getElementById('responseTimeChart').getContext('2d');
        const responseChart = new Chart(responseCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Response Time (ms)',
                    data: [],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Real-time data simulation
        function updateCharts() {
            const now = new Date();
            const timeLabel = now.getHours().toString().padStart(2, '0') + ':' +
                now.getMinutes().toString().padStart(2, '0') + ':' +
                now.getSeconds().toString().padStart(2, '0');

            // Update traffic chart
            trafficChart.data.labels.push(timeLabel);
            trafficChart.data.datasets[0].data.push(Math.floor(Math.random() * 200) + 100);

            if (trafficChart.data.labels.length > 20) {
                trafficChart.data.labels.shift();
                trafficChart.data.datasets[0].data.shift();
            }
            trafficChart.update('none');

            // Update response time chart
            responseChart.data.labels.push(timeLabel);
            responseChart.data.datasets[0].data.push(Math.floor(Math.random() * 300) + 200);

            if (responseChart.data.labels.length > 20) {
                responseChart.data.labels.shift();
                responseChart.data.datasets[0].data.shift();
            }
            responseChart.update('none');

            // Update last update time
            document.getElementById('lastUpdate').textContent = timeLabel;
        }

        // Initialize with some data
        for (let i = 0; i < 10; i++) {
            updateCharts();
        }

        // Update every 5 seconds
        setInterval(updateCharts, 5000);

        // Auto-refresh page every 5 minutes
        setInterval(function() {
            location.reload();
        }, 300000);
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/realtime-monitoring.blade.php ENDPATH**/ ?>