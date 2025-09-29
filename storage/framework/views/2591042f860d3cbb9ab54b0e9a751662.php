<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Subdomain -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold opacity-90">Total Subdomain</h3>
                            <p class="text-3xl font-bold"><?php echo e($stats['subdomain_sama'] ?? 0); ?></p>
                            <p class="text-sm opacity-90">Subdomain Sama</p>
                        </div>
                        <div class="text-4xl opacity-60">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Domain Aktif -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold opacity-90">Domain Aktif</h3>
                            <p class="text-3xl font-bold"><?php echo e($stats['aktif'] ?? 0); ?></p>
                            <p class="text-sm opacity-90">Status Online</p>
                        </div>
                        <div class="text-4xl opacity-60">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Domain Tidak Aktif -->
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold opacity-90">Domain Tidak Aktif</h3>
                            <p class="text-3xl font-bold"><?php echo e($stats['tidak_aktif'] ?? 0); ?></p>
                            <p class="text-sm opacity-90">Status Offline</p>
                        </div>
                        <div class="text-4xl opacity-60">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kategori Domain -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold opacity-90">Kategori Domain</h3>
                            <p class="text-3xl font-bold"><?php echo e($stats['kategori_domain'] ?? 0); ?></p>
                            <p class="text-sm opacity-90">Jenis Berbeda</p>
                        </div>
                        <div class="text-4xl opacity-60">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- IP Address Distribution Chart -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 heading-font">Distribusi IP Address</h3>
                    <canvas id="ipAddressChart" width="400" height="200"></canvas>
                </div>

                <!-- Status by OPD Chart -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 heading-font">Status Subdomain per OPD</h3>
                    <canvas id="statusByOpdChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Pie Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Status Distribution Pie Chart -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 heading-font">Persentase Status Domain</h3>
                    <canvas id="statusPieChart" width="300" height="300"></canvas>
                </div>

                <!-- Domain Type Distribution Pie Chart -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 heading-font">Persentase Jenis Domain</h3>
                    <canvas id="domainPieChart" width="300" height="300"></canvas>
                </div>
            </div>

            <!-- Recent Data Table -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold mb-4 heading-font">Data Terbaru dari Google Sheets</h3>
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-900">Nama</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-900">Gender</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-900">Kelas</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-900">Asal</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-900">Jurusan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $sheetsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm"><?php echo e($row['name'] ?? 'N/A'); ?></td>
                                <td class="px-4 py-2 text-sm"><?php echo e($row['gender'] ?? 'N/A'); ?></td>
                                <td class="px-4 py-2 text-sm"><?php echo e($row['class_level'] ?? 'N/A'); ?></td>
                                <td class="px-4 py-2 text-sm"><?php echo e($row['home_state'] ?? 'N/A'); ?></td>
                                <td class="px-4 py-2 text-sm"><?php echo e($row['major'] ?? 'N/A'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    Tidak ada data dari Google Sheets. Silakan periksa koneksi API.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // IP Address Distribution Chart
        const ipCtx = document.getElementById('ipAddressChart').getContext('2d');
        new Chart(ipCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($ipAddressChart ?? [])); ?>,
                datasets: [{
                    label: 'Jumlah Domain',
                    data: <?php echo json_encode(array_values($ipAddressChart ?? [])); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Status by OPD Chart
        const opdCtx = document.getElementById('statusByOpdChart').getContext('2d');
        new Chart(opdCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(collect($statusByOpdChart ?? [])->pluck('nama_opd')->toArray()); ?>,
                datasets: [
                    {
                        label: 'Aktif',
                        data: <?php echo json_encode(collect($statusByOpdChart ?? [])->pluck('aktif')->toArray()); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    },
                    {
                        label: 'Tidak Aktif',
                        data: <?php echo json_encode(collect($statusByOpdChart ?? [])->pluck('tidak_aktif')->toArray()); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Status Distribution Pie Chart
        const statusPieCtx = document.getElementById('statusPieChart').getContext('2d');
        new Chart(statusPieCtx, {
            type: 'pie',
            data: {
                labels: ['Aktif', 'Tidak Aktif'],
                datasets: [{
                    data: [
                        <?php echo e($statusDistribution['aktif'] ?? 0); ?>,
                        <?php echo e($statusDistribution['tidak_aktif'] ?? 0); ?>

                    ],
                    backgroundColor: ['#10B981', '#EF4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Domain Type Distribution Pie Chart
        const domainPieCtx = document.getElementById('domainPieChart').getContext('2d');
        new Chart(domainPieCtx, {
            type: 'pie',
            data: {
                labels: ['Tidak Aktif', 'Aktif', 'Local'],
                datasets: [{
                    data: [
                        <?php echo e($domainDistribution['tidak_aktif'] ?? 0); ?>,
                        <?php echo e($domainDistribution['aktif'] ?? 0); ?>,
                        <?php echo e($domainDistribution['local'] ?? 0); ?>

                    ],
                    backgroundColor: ['#EF4444', '#10B981', '#3B82F6']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/dashboard.blade.php ENDPATH**/ ?>