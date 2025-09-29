<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Domain Monitoring - Dashboard Diskominfo Purwakarta</title>
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
    </style>
</head>

<body class="min-h-screen"
      style="background: radial-gradient(ellipse at top, #f0f9ff, #e0f2fe), linear-gradient(to bottom, #f8fafc, #f1f5f9);">
    @include('layouts.navbar')

    <div class="container mx-auto px-4">
        <!-- Page Title -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Health Domain Monitoring</h2>
            <p class="text-gray-600">Monitoring kesehatan dan status domain secara real-time</p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card-green text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">TOTAL DOMAINS</h3>
                <p class="text-3xl font-bold">{{ $healthStats['total_domains'] }}</p>
            </div>
            <div class="card-blue text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">HEALTHY DOMAINS</h3>
                <p class="text-3xl font-bold">{{ $healthStats['healthy_domains'] }}</p>
            </div>
            <div class="card-red text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">UNHEALTHY DOMAINS</h3>
                <p class="text-3xl font-bold">{{ $healthStats['unhealthy_domains'] }}</p>
            </div>
            <div class="card-orange text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm font-medium opacity-90">PENDING CHECKS</h3>
                <p class="text-3xl font-bold">{{ $healthStats['pending_checks'] }}</p>
            </div>
        </div>

        <!-- Domain Health Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Domain Health Status</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Domain</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OPD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Response Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SSL Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Check</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($domainHealth as $domain)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $domain['domain'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $domain['opd'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $domain['status'] === 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $domain['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $domain['response_time'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $domain['ssl_status'] === 'Valid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $domain['ssl_status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $domain['last_check'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-3">Check Now</button>
                                <button class="text-gray-600 hover:text-gray-900">Details</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Auto-refresh indicator -->
        <div class="mt-6 text-center">
            <div class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-lg">
                <div class="animate-pulse w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                <span class="text-sm text-blue-700">Auto-refresh every 30 seconds</span>
            </div>
        </div>
    </div>

    <script>
        // Auto-refresh page every 30 seconds
        setInterval(function() {
            location.reload();
        }, 30000);
    </script>
</body>

</html>