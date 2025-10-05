<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Subdomain dan OPD Purwakarta - Diskominfo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Noto Sans', Helvetica, Arial, sans-serif;
            background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe),
                linear-gradient(to bottom, #f8fafc, #f1f5f9);
        }

        .bg-primary {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6, #60a5fa);
        }

        .card-orange {
            background: linear-gradient(135deg, #ea580c, #f97316);
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.3);
        }

        .card-red {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
        }

        .card-green {
            background: linear-gradient(135deg, #059669, #10b981);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }

        .card-yellow {
            background: linear-gradient(135deg, #d97706, #f59e0b);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
        }

        .card-pink {
            background: linear-gradient(135deg, #be185d, #ec4899);
            box-shadow: 0 10px 25px rgba(236, 72, 153, 0.3);
        }

        .card-cyan {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
            box-shadow: 0 10px 25px rgba(6, 182, 212, 0.3);
        }

        .github-gradient {
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

        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>

<body class="min-h-screen"
    style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    @include('layouts.navbar')

    <!-- Header Section -->
    <div class="bg-primary text-white py-6 mb-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">DASHBOARD DATA SUBDOMAIN DAN OPD PURWAKARTA</h1>
                        <h2 class="text-lg opacity-90">Dinas Komunikasi dan Informatika</h2>
                        <p class="text-sm opacity-75">Monitoring subdomain aktif/tidak aktif pada OPD Purwakarta</p>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('admin.spreadsheet-links.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg text-sm font-medium">
                        Kelola Data
                    </a>
                    @if($activeSpreadsheet)
                    <p class="text-xs opacity-75 mt-2">Sumber: {{ $activeSpreadsheet->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mb-8">
            <div class="card-orange text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">NAMA OPD</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['total_opd'] }}</p>
            </div>
            <div class="card-red text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">DOMAIN</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['total_domains'] }}</p>
            </div>
            <div class="card-green text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">SUBDOMAIN AKTIF</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['active_subdomains'] }}</p>
            </div>
            <div class="card-red text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">SUBDOMAIN TIDAK AKTIF</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['inactive_subdomains'] }}</p>
            </div>
            <div class="card-yellow text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">PROS BACKUP</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['backup_progress'] }}</p>
            </div>
            <div class="card-pink text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">PROS PENGATURAN</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['backup_pending'] }}</p>
            </div>
            <div class="card-cyan text-white p-4 rounded-lg shadow-lg">
                <h3 class="text-xs font-medium opacity-90">SELESAI BACKUP</h3>
                <p class="text-2xl font-bold">{{ $subdomainStats['backup_completed'] }}</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Status Domain Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Status Domain Berdasarkan Nama OPD</h3>
                <div class="text-sm text-gray-600 mb-4">
                    <span class="inline-flex items-center space-x-2">
                        <div class="w-3 h-3 bg-green-500 rounded"></div>
                        <span>Aktif</span>
                    </span>
                    <span class="inline-flex items-center space-x-2 ml-4">
                        <div class="w-3 h-3 bg-red-500 rounded"></div>
                        <span>Tidak Aktif</span>
                    </span>
                </div>
                <div style="height: 300px;">
                    <canvas id="opdStatusChart"></canvas>
                </div>
            </div>

            <!-- Status Domain Pie Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Status Domain Berdasarkan...</h3>
                <div style="height: 300px;">
                    <canvas id="statusPieChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Kecamatan Data Table -->
        @if(count($kecamatanData) > 0)
        <div class="bg-white rounded-lg shadow-lg mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">KECAMATAN TEGALWARU</h3>
                <p class="text-sm text-gray-600">Domain yang terhitung</p>
            </div>
            <div class="p-6">
                @foreach($kecamatanData as $kecamatan)
                <div class="mb-6">
                    <h4 class="text-md font-semibold mb-3">{{ $kecamatan['kecamatan'] }}</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Record Count</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($kecamatan['domains'] as $index => $domain)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-sm">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $domain['domain'] }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $domain['count'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- OPD Data Table -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Data OPD dan Status Domain</h3>
                    <p class="text-sm text-gray-600">Daftar seluruh OPD dengan status subdomain</p>
                </div>
                <div class="flex space-x-2">
                    <span class="text-sm bg-green-100 text-green-800 px-2 py-1 rounded">Aktif: {{ $subdomainStats['active_subdomains'] }}</span>
                    <span class="text-sm bg-red-100 text-red-800 px-2 py-1 rounded">Tidak Aktif: {{ $subdomainStats['inactive_subdomains'] }}</span>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPD Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domain Count</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pros Backup</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selesai Backup</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pros Pengaturan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($opdData as $index => $opd)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $index + 1 }}. {{ $opd['name'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opd['domain_count'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $opd['active_subdomains'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">0</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">Total tersusun..</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $subdomainStats['total_domains'] }}</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $subdomainStats['backup_progress'] }}</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $subdomainStats['backup_completed'] }}</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $subdomainStats['backup_pending'] }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="px-6 py-3 bg-gray-50 text-right">
                <span class="text-sm text-gray-500">1 - 100 / 112</span>
            </div>
        </div>

        <!-- Chart Progress Section -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-blue-600">Progress Backup Timeline</h3>
            <div style="height: 200px;">
                <canvas id="progressChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // OPD Status Bar Chart
        const opdCtx = document.getElementById('opdStatusChart').getContext('2d');
        const opdChart = new Chart(opdCtx, {
            type: 'bar',
            data: {
                labels: @json(array_column($opdData, 'name')),
                datasets: [{
                    label: 'Aktif',
                    data: @json(array_column($opdData, 'active_subdomains')),
                    backgroundColor: '#10b981',
                    stack: 'stack1'
                }, {
                    label: 'Tidak Aktif',
                    data: @json(array_column($opdData, 'inactive_subdomains')),
                    backgroundColor: '#ef4444',
                    stack: 'stack1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });

        // Status Pie Chart
        const pieCtx = document.getElementById('statusPieChart').getContext('2d');
        const pieChart = new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Aktif', 'Tidak Aktif'],
                datasets: [{
                    data: [{
                        {
                            $subdomainStats['active_subdomains']
                        }
                    }, {
                        {
                            $subdomainStats['inactive_subdomains']
                        }
                    }],
                    backgroundColor: ['#10b981', '#ef4444', '#f59e0b', '#8b5cf6', '#06b6d4']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Progress Timeline Chart
        const progressCtx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(progressCtx, {
            type: 'line',
            data: {
                labels: ['2025-07-30', '2025-08-07', '2025-08-22', 'Incoming'],
                datasets: [{
                    label: 'Pros Backup',
                    data: [10, 8, 5, 3],
                    borderColor: '#3b82f6',
                    tension: 0.4
                }, {
                    label: 'Selesai Backup',
                    data: [12, 10, 7, 5],
                    borderColor: '#10b981',
                    tension: 0.4
                }, {
                    label: 'Pros Pengaturan',
                    data: [15, 12, 8, 6],
                    borderColor: '#f59e0b',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>