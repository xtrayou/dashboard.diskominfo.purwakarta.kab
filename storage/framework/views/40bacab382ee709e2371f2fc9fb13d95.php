<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Link Spreadsheet - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen"
      style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Link Spreadsheet</h1>
                <p class="text-gray-600">Informasi lengkap dan preview data</p>
            </div>
            <div class="flex space-x-3">
                <a href="<?php echo e(route('admin.spreadsheet-links.edit', $spreadsheetLink)); ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                    Edit
                </a>
                <button onclick="testConnection()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Test Koneksi
                </button>
                <a href="<?php echo e(route('admin.spreadsheet-links.index')); ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg">
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Detail Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Link</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama</label>
                            <p class="text-gray-900 font-medium"><?php echo e($spreadsheetLink->name); ?></p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Status</label>
                            <div class="mt-1">
                                <?php if($spreadsheetLink->is_active): ?>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                                <?php else: ?>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Tidak Aktif
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">URL</label>
                            <p class="text-gray-900 break-all text-sm"><?php echo e($spreadsheetLink->url); ?></p>
                            <a href="<?php echo e($spreadsheetLink->url); ?>" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                Buka di Google Sheets ↗
                            </a>
                        </div>

                        <?php if($spreadsheetLink->sheet_id): ?>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Sheet ID</label>
                            <p class="text-gray-900 font-mono text-sm bg-gray-100 p-2 rounded"><?php echo e($spreadsheetLink->sheet_id); ?></p>
                        </div>
                        <?php endif; ?>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Range Data</label>
                            <p class="text-gray-900"><?php echo e($spreadsheetLink->range); ?></p>
                        </div>

                        <?php if($spreadsheetLink->description): ?>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Deskripsi</label>
                            <p class="text-gray-900"><?php echo e($spreadsheetLink->description); ?></p>
                        </div>
                        <?php endif; ?>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Dibuat</label>
                            <p class="text-gray-900"><?php echo e($spreadsheetLink->created_at->format('d/m/Y H:i')); ?></p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Terakhir Update</label>
                            <p class="text-gray-900"><?php echo e($spreadsheetLink->updated_at->format('d/m/Y H:i')); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Preview -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Preview Data</h2>

                    <div id="loadingData" class="text-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-gray-600">Loading data...</p>
                    </div>

                    <div id="dataPreview" class="hidden">
                        <!-- Summary Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-blue-800">Total OPD</h3>
                                <p class="text-2xl font-bold text-blue-900" id="totalOpd">-</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-green-800">Domain Aktif</h3>
                                <p class="text-2xl font-bold text-green-900" id="activeDomains">-</p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-red-800">Domain Tidak Aktif</h3>
                                <p class="text-2xl font-bold text-red-900" id="inactiveDomains">-</p>
                            </div>
                            <div class="bg-yellow-50 p-4 rounded-lg">
                                <h3 class="text-sm font-medium text-yellow-800">Total Domain</h3>
                                <p class="text-2xl font-bold text-yellow-900" id="totalDomains">-</p>
                            </div>
                        </div>

                        <!-- Sample Data Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">OPD</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Domain Count</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Aktif</th>
                                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tidak Aktif</th>
                                    </tr>
                                </thead>
                                <tbody id="sampleDataTable" class="divide-y divide-gray-200">
                                    <!-- Data will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="errorData" class="hidden text-center py-8">
                        <div class="text-red-500 mb-4">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Gagal Memuat Data</h3>
                        <p class="text-gray-600" id="errorMessage">Terjadi kesalahan saat mengambil data dari spreadsheet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function testConnection() {
            const loadingDiv = document.getElementById('loadingData');
            const previewDiv = document.getElementById('dataPreview');
            const errorDiv = document.getElementById('errorData');

            loadingDiv.classList.remove('hidden');
            previewDiv.classList.add('hidden');
            errorDiv.classList.add('hidden');

            fetch(`/admin/spreadsheet-links/<?php echo e($spreadsheetLink->id); ?>/test`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    loadingDiv.classList.add('hidden');

                    if (data.success) {
                        // Show success message
                        alert(`Koneksi berhasil! Ditemukan ${data.data_count} data OPD.`);
                        loadPreviewData();
                    } else {
                        errorDiv.classList.remove('hidden');
                        document.getElementById('errorMessage').textContent = data.message;
                    }
                })
                .catch(error => {
                    loadingDiv.classList.add('hidden');
                    errorDiv.classList.remove('hidden');
                    document.getElementById('errorMessage').textContent = 'Terjadi kesalahan jaringan';
                });
        }

        function loadPreviewData() {
            // Mock data for preview - in production this would fetch real data
            const mockData = {
                summary: {
                    total_opd: 48,
                    total_domains: 228,
                    active_subdomains: 161,
                    inactive_subdomains: 67
                },
                opd_data: [{
                        name: 'BADAN KEPEGAWAIAN',
                        domain_count: 5,
                        active_subdomains: 3,
                        inactive_subdomains: 2
                    },
                    {
                        name: 'BADAN KEUANGAN',
                        domain_count: 8,
                        active_subdomains: 6,
                        inactive_subdomains: 2
                    },
                    {
                        name: 'DINAS PENDIDIKAN',
                        domain_count: 12,
                        active_subdomains: 10,
                        inactive_subdomains: 2
                    },
                    {
                        name: 'DINAS KESEHATAN',
                        domain_count: 15,
                        active_subdomains: 12,
                        inactive_subdomains: 3
                    },
                    {
                        name: 'SEKRETARIAT DAERAH',
                        domain_count: 20,
                        active_subdomains: 18,
                        inactive_subdomains: 2
                    }
                ]
            };

            // Update summary cards
            document.getElementById('totalOpd').textContent = mockData.summary.total_opd;
            document.getElementById('activeDomains').textContent = mockData.summary.active_subdomains;
            document.getElementById('inactiveDomains').textContent = mockData.summary.inactive_subdomains;
            document.getElementById('totalDomains').textContent = mockData.summary.total_domains;

            // Update table
            const tbody = document.getElementById('sampleDataTable');
            tbody.innerHTML = '';

            mockData.opd_data.forEach(opd => {
                const row = tbody.insertRow();
                row.innerHTML = `
                    <td class="px-4 py-2 text-sm font-medium text-gray-900">${opd.name}</td>
                    <td class="px-4 py-2 text-sm text-gray-900">${opd.domain_count}</td>
                    <td class="px-4 py-2 text-sm text-green-600 font-medium">${opd.active_subdomains}</td>
                    <td class="px-4 py-2 text-sm text-red-600 font-medium">${opd.inactive_subdomains}</td>
                `;
            });

            document.getElementById('dataPreview').classList.remove('hidden');
        }

        // Load preview data on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(loadPreviewData, 1000);
        });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\DISKOMINFO\laravel\dashboard.diskominfo.purwakarta.kab\resources\views/admin/spreadsheet-links/show.blade.php ENDPATH**/ ?>