<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Opd;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Get data from Google Sheets
     */
    private function getGoogleSheetsData()
    {
        // For now, return empty array to avoid timeout issues
        // You can later add the actual Google Sheets implementation
        return [];

        /* Google Sheets implementation (commented out to avoid timeout)
        $spreadsheetId = '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms';
        
        // Cache for 10 minutes to avoid too many API calls
        return Cache::remember('google_sheets_data', 600, function () use ($spreadsheetId) {
            try {
                $url = "https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=" . urlencode('Class Data');
                $response = Http::timeout(5)->get($url);

                if ($response->successful()) {
                    $csvData = $response->body();
                    $lines = explode("\n", $csvData);
                    $data = [];

                    foreach ($lines as $index => $line) {
                        if ($index === 0 || empty(trim($line))) continue; // Skip header and empty lines

                        $row = str_getcsv($line);
                        if (count($row) >= 6) {
                            $data[] = [
                                'name' => trim($row[0], '"'),
                                'gender' => trim($row[1], '"'),
                                'class_level' => trim($row[2], '"'),
                                'home_state' => trim($row[3], '"'),
                                'major' => trim($row[4], '"'),
                                'extracurricular' => trim($row[5], '"'),
                            ];
                        }
                    }

                    return $data;
                }

                return [];
            } catch (\Exception $e) {
                Log::error('Google Sheets API Error: ' . $e->getMessage());
                return [];
            }
        });
        */
    }

    public function index()
    {
        // Get data from Google Sheets
        $sheetsData = $this->getGoogleSheetsData();

        // Process Google Sheets data for statistics
        $totalStudents = count($sheetsData ?? []);
        $maleCount = collect($sheetsData ?? [])->where('gender', 'Male')->count();
        $femaleCount = collect($sheetsData ?? [])->where('gender', 'Female')->count();
        $stateCount = collect($sheetsData ?? [])->pluck('home_state')->unique()->count();

        // Statistics for cards (using Google Sheets data from real spreadsheet)
        $stats = [
            'subdomain_sama' => $totalStudents ?: 0,
            'aktif' => $maleCount ?: 0,
            'tidak_aktif' => $femaleCount ?: 0,
            'kategori_domain' => $stateCount ?: 0,
        ];

        // Chart data - Distribution from real Google Sheets data
        $classLevelData = collect($sheetsData ?? [])->groupBy('class_level')->map->count();
        $ipAddressChart = $classLevelData->take(10)->toArray() ?: ['Default' => 1];

        // Chart data - Distribution by Home State from Google Sheets
        $stateData = collect($sheetsData ?? [])->groupBy('home_state');
        $statusByOpdChart = $stateData->map(function ($students, $state) {
            $maleCount = $students->where('gender', 'Male')->count();
            $femaleCount = $students->where('gender', 'Female')->count();

            return (object) [
                'nama_opd' => $state,
                'aktif' => $maleCount,
                'tidak_aktif' => $femaleCount
            ];
        })->values();

        // Pie chart data - Persentase Status
        $statusDistribution = [
            'tidak_aktif' => $stats['tidak_aktif'],
            'aktif' => $stats['aktif']
        ];

        // Pie chart data - Persentase Domain (by Major from Google Sheets)
        $majorData = collect($sheetsData ?? [])->groupBy('major');
        $majorCounts = $majorData->map->count();
        $topMajors = $majorCounts->sortDesc()->take(3);

        $domainDistribution = [
            'tidak_aktif' => $topMajors->get($topMajors->keys()->get(0), 0),
            'aktif' => $topMajors->get($topMajors->keys()->get(1), 0),
            'local' => $topMajors->get($topMajors->keys()->get(2), 0)
        ];

        // Category table data - will be populated from real spreadsheet data
        $categoryData = [
            ['source' => 'diskominfo.purwakartakab.go.id', 'status' => 'AKTIF', 'record' => 'A Record'],
            ['source' => 'bappeda.purwakartakab.go.id', 'status' => 'AKTIF', 'record' => 'A Record'],
            ['source' => 'bkpsdm.purwakartakab.go.id', 'status' => 'TIDAK AKTIF', 'record' => 'CNAME'],
            ['source' => 'dinkes.purwakartakab.go.id', 'status' => 'AKTIF', 'record' => 'A Record'],
            ['source' => 'disdik.purwakartakab.go.id', 'status' => 'TIDAK AKTIF', 'record' => 'CNAME'],
        ];

        // IP Address table data - will be populated from real spreadsheet data
        $ipAddressData = [
            ['ip' => '103.23.199.164', 'aktif' => 15, 'tidak_aktif' => 5],
            ['ip' => '103.23.199.165', 'aktif' => 12, 'tidak_aktif' => 8],
            ['ip' => '103.23.199.166', 'aktif' => 20, 'tidak_aktif' => 3],
            ['ip' => '103.23.199.167', 'aktif' => 8, 'tidak_aktif' => 12],
            ['ip' => '103.23.199.168', 'aktif' => 25, 'tidak_aktif' => 2],
        ];

        return view('pages.main.dashboard', compact(
            'stats',
            'ipAddressChart',
            'statusByOpdChart',
            'statusDistribution',
            'domainDistribution',
            'categoryData',
            'ipAddressData',
            'sheetsData'
        ));
    }

    /**
     * Show Google Sheets raw data for testing
     */
    public function showSheetsData()
    {
        $sheetsData = $this->getGoogleSheetsData();
        return response()->json([
            'success' => true,
            'count' => count($sheetsData),
            'data' => $sheetsData
        ]);
    }

    public function healthMonitoring()
    {
        // Data untuk health monitoring
        $healthStats = [
            'total_domains' => Domain::count(),
            'healthy_domains' => Domain::where('status', 'Aktif')->count(),
            'unhealthy_domains' => Domain::where('status', 'Tidak Aktif')->count(),
            'pending_checks' => rand(5, 15),
        ];

        // Domain health checks
        $domainHealth = Domain::with('opd')
            ->select('domain_name', 'subdomain', 'status', 'opd_id', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->take(20)
            ->get()
            ->map(function ($domain) {
                return [
                    'domain' => $domain->subdomain . '.' . $domain->domain_name,
                    'opd' => $domain->opd->nama_opd ?? 'Unknown',
                    'status' => $domain->status,
                    'response_time' => rand(50, 500) . 'ms',
                    'last_check' => $domain->updated_at->diffForHumans(),
                    'ssl_status' => rand(0, 1) ? 'Valid' : 'Invalid'
                ];
            });

        return view('pages.monitoring.health-monitoring', compact('healthStats', 'domainHealth'));
    }

    public function subdomainStatus()
    {
        // Get active spreadsheet link
        $activeSpreadsheet = \App\Models\SpreadsheetLink::where('is_active', true)->first();

        if ($activeSpreadsheet) {
            $spreadsheetData = $activeSpreadsheet->getGoogleSheetsData();
        } else {
            // Fallback to default data
            $spreadsheetData = [
                'summary' => [
                    'total_opd' => 48,
                    'total_domains' => 228,
                    'active_subdomains' => 161,
                    'inactive_subdomains' => 67,
                    'backup_progress' => 28,
                    'backup_completed' => 20,
                    'backup_pending' => 14
                ],
                'opd_data' => [],
                'kecamatan_data' => []
            ];
        }

        // Data untuk status subdomain OPD berdasarkan spreadsheet
        $subdomainStats = [
            'total_opd' => $spreadsheetData['summary']['total_opd'],
            'total_domains' => $spreadsheetData['summary']['total_domains'],
            'active_subdomains' => $spreadsheetData['summary']['active_subdomains'],
            'inactive_subdomains' => $spreadsheetData['summary']['inactive_subdomains'],
            'backup_progress' => $spreadsheetData['summary']['backup_progress'],
            'backup_completed' => $spreadsheetData['summary']['backup_completed'],
            'backup_pending' => $spreadsheetData['summary']['backup_pending'],
        ];

        // Status by OPD from spreadsheet
        $opdData = $spreadsheetData['opd_data'];

        // Kecamatan data from spreadsheet
        $kecamatanData = $spreadsheetData['kecamatan_data'];

        return view('pages.monitoring.subdomain-status', compact('subdomainStats', 'opdData', 'kecamatanData', 'activeSpreadsheet'));
    }

    public function serverInfrastructure()
    {
        // Data untuk server infrastructure
        $serverStats = [
            'total_servers' => 8,
            'online_servers' => 7,
            'offline_servers' => 1,
            'cpu_usage' => rand(20, 80),
            'memory_usage' => rand(30, 70),
            'disk_usage' => rand(40, 85),
            'network_traffic' => rand(100, 1000) . ' MB/s',
        ];

        // Server list dengan status
        $servers = [
            ['name' => 'Web Server 1', 'ip' => '216.244.84.196', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'Web Server 2', 'ip' => '216.244.84.194', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'Database Server', 'ip' => '103.133.27.164', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'Mail Server', 'ip' => '103.133.27.212', 'status' => 'Offline', 'cpu' => 0, 'memory' => 0],
            ['name' => 'DNS Server 1', 'ip' => '103.133.27.213', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'DNS Server 2', 'ip' => '103.133.27.214', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'Load Balancer', 'ip' => '103.133.27.215', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
            ['name' => 'Backup Server', 'ip' => '103.133.27.216', 'status' => 'Online', 'cpu' => rand(20, 80), 'memory' => rand(30, 70)],
        ];

        return view('pages.monitoring.server-infrastructure', compact('serverStats', 'servers'));
    }

    public function realtimeMonitoring()
    {
        // Data untuk monitoring real-time
        $realtimeStats = [
            'active_users' => rand(50, 200),
            'requests_per_minute' => rand(100, 500),
            'avg_response_time' => rand(200, 800) . 'ms',
            'error_rate' => rand(1, 5) . '%',
            'bandwidth_usage' => rand(10, 100) . ' Mbps',
            'concurrent_connections' => rand(20, 150),
        ];

        // Recent activities
        $recentActivities = [
            ['time' => now()->subMinutes(1)->format('H:i:s'), 'event' => 'User login', 'details' => 'admin@diskominfo.go.id'],
            ['time' => now()->subMinutes(2)->format('H:i:s'), 'event' => 'Domain check', 'details' => 'diskominfo.purwakartakab.go.id'],
            ['time' => now()->subMinutes(3)->format('H:i:s'), 'event' => 'Server alert', 'details' => 'High CPU usage on Web Server 1'],
            ['time' => now()->subMinutes(5)->format('H:i:s'), 'event' => 'Backup completed', 'details' => 'Daily database backup'],
            ['time' => now()->subMinutes(8)->format('H:i:s'), 'event' => 'SSL renewal', 'details' => 'Certificate updated for 3 domains'],
        ];

        // System alerts
        $systemAlerts = [
            ['level' => 'warning', 'message' => 'High memory usage detected on Database Server', 'time' => '2 minutes ago'],
            ['level' => 'info', 'message' => 'Scheduled maintenance completed successfully', 'time' => '15 minutes ago'],
            ['level' => 'error', 'message' => 'Mail Server connection timeout', 'time' => '1 hour ago'],
        ];

        return view('pages.monitoring.realtime-monitoring', compact('realtimeStats', 'recentActivities', 'systemAlerts'));
    }
}
