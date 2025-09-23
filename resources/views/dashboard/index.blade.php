<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold">Dashboard Data Subdomain dan OPD Purwakarta</h2>
            <p class="text-blue-100 mt-1">Dinas Komunikasi dan Informatika</p>
            <p class="text-sm text-blue-200">Monitoring subdomain aktivitas aktif pada OPD Purwakarta</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-6">
                <div class="bg-orange-400 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">NAMA OPD</h3>
                    <p class="text-2xl font-bold">{{ $stats['total_opd'] }}</p>
                </div>
                <div class="bg-red-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">DOMAIN</h3>
                    <p class="text-2xl font-bold">{{ $stats['total_domains'] }}</p>
                </div>
                <div class="bg-green-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">SUBDOMAIN AKTIF</h3>
                    <p class="text-2xl font-bold">{{ $stats['active_subdomains'] }}</p>
                </div>
                <div class="bg-red-600 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">SUBDOMAIN TIDAK AKTIF</h3>
                    <p class="text-2xl font-bold">{{ $stats['inactive_subdomains'] }}</p>
                </div>
                <div class="bg-yellow-400 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">PROS BACKUP</h3>
                    <p class="text-2xl font-bold">{{ $stats['backup_pros'] }}</p>
                </div>
                <div class="bg-orange-500 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">PROS PENGHAPUSAN</h3>
                    <p class="text-2xl font-bold">14</p>
                </div>
                <div class="bg-orange-400 text-white p-4 rounded-lg shadow">
                    <h3 class="text-sm font-medium">SELESAI BACKUP</h3>
                    <p class="text-2xl font-bold">{{ $stats['backup_selesai'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Chart Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Status Domain Berdasarkan Nama OPD</h3>
                        <canvas id="domainChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Status Domain</h3>
                        <canvas id="pieChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="mt-6 bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Domain Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">OPD Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Domain</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Backup Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($recentDomains as $domain)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $domain->opd->nama_opd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $domain->domain_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $domain->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($domain->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $domain->backup_date ? $domain->backup_date->format('Y-m-d') : '-' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar Chart
        const opdLabels = {!! json_encode($domainsByOpd->pluck('nama_opd')) !!};
        const aktifData = {!! json_encode($domainsByOpd->pluck('aktif')) !!};
        const tidakAktifData = {!! json_encode($domainsByOpd->pluck('tidak_aktif')) !!};
        
        const ctx = document.getElementById('domainChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: opdLabels,
                datasets: [{
                    label: 'Aktif',
                    data: aktifData,
                    backgroundColor: '#10B981',
                }, {
                    label: 'Tidak Aktif',
                    data: tidakAktifData,
                    backgroundColor: '#EF4444',
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

        // Pie Chart
        const statusData = {!! json_encode([$statusDistribution['aktif'], $statusDistribution['tidak_aktif']]) !!};
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Aktif', 'Tidak Aktif'],
                datasets: [{
                    data: statusData,
                    backgroundColor: ['#10B981', '#EF4444']
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
    @endpush
</x-app-layout>