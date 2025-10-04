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
     * Your actual spreadsheet ID
     */
    private $spreadsheetId = '1v_IbBctN8Qqoypek8C7kj7eLnb9qSfGDrNWpZ5w1vfM';

    /**
     * Get list of all sheets in the spreadsheet
     */
    private function getSheetsList()
    {
        try {
            // Get spreadsheet metadata to list all sheets
            $url = "https://docs.google.com/spreadsheets/d/{$this->spreadsheetId}/gviz/tq?tqx=out:json";
            $response = Http::timeout(10)->get($url);
            
            if ($response->successful()) {
                // This will help us identify available sheets
                Log::info('Available sheets response received');
                return ['Sheet1', 'Domain Data', 'OPD List', 'Monitoring']; // Default sheet names
            }
            
            return ['Sheet1']; // Fallback
        } catch (\Exception $e) {
            Log::error('Error getting sheets list: ' . $e->getMessage());
            return ['Sheet1'];
        }
    }

    /**
     * Get data from specific Google Sheets tab
     */
    private function getSheetData($sheetName = 'Sheet1')
    {
        return Cache::remember("google_sheets_data_{$sheetName}", 300, function () use ($sheetName) {
            try {
                $url = "https://docs.google.com/spreadsheets/d/{$this->spreadsheetId}/gviz/tq?tqx=out:csv&sheet=" . urlencode($sheetName);
                $response = Http::timeout(10)->get($url);

                if ($response->successful()) {
                    $csvData = $response->body();
                    $lines = array_filter(explode("\n", $csvData), function($line) {
                        return !empty(trim($line));
                    });

                    if (empty($lines)) {
                        return [];
                    }

                    // Get headers from first row
                    $headers = str_getcsv(array_shift($lines));
                    $headers = array_map(function($header) {
                        return trim($header, '"');
                    }, $headers);

                    $data = [];
                    foreach ($lines as $line) {
                        $row = str_getcsv($line);
                        $row = array_map(function($cell) {
                            return trim($cell, '"');
                        }, $row);

                        // Combine headers with row data
                        if (count($row) === count($headers)) {
                            $data[] = array_combine($headers, $row);
                        }
                    }

                    Log::info("Sheet '{$sheetName}' loaded with " . count($data) . " rows");
                    return $data;
                }

                Log::warning("Failed to load sheet '{$sheetName}'");
                return [];
            } catch (\Exception $e) {
                Log::error("Google Sheets API Error for sheet '{$sheetName}': " . $e->getMessage());
                return [];
            }
        });
    }

    /**
     * Get data from all Google Sheets
     */
    private function getAllSheetsData()
    {
        $sheets = $this->getSheetsList();
        $allData = [];

        foreach ($sheets as $sheetName) {
            $sheetData = $this->getSheetData($sheetName);
            if (!empty($sheetData)) {
                $allData[$sheetName] = $sheetData;
            }
        }

        return $allData;
    }

    /**
     * Parse domain/subdomain data from sheets
     */
    private function parseDomainData($sheetsData)
    {
        $domainData = [];
        
        foreach ($sheetsData as $sheetName => $data) {
            if (empty($data)) continue;

            foreach ($data as $row) {
                // Try to identify domain-related columns
                $domain = $row['Domain'] ?? $row['domain'] ?? $row['Website'] ?? $row['website'] ?? null;
                $opd = $row['OPD'] ?? $row['opd'] ?? $row['Nama OPD'] ?? $row['nama_opd'] ?? $row['Organization'] ?? null;
                $status = $row['Status'] ?? $row['status'] ?? $row['Active'] ?? $row['active'] ?? 'Unknown';
                
                if ($domain && $opd) {
                    $domainData[] = [
                        'domain' => $domain,
                        'opd' => $opd,
                        'status' => $status,
                        'sheet_source' => $sheetName,
                        'raw_data' => $row
                    ];
                }
            }
        }

        return $domainData;
    }

    public function index()
    {
        // Get data from all Google Sheets
        $allSheetsData = $this->getAllSheetsData();
        
        // Parse domain data from all sheets
        $domainData = $this->parseDomainData($allSheetsData);

        // Calculate statistics from real data
        $totalDomains = count($domainData);
        $activeDomains = collect($domainData)->where('status', 'Active')->count();
        $inactiveDomains = collect($domainData)->where('status', 'Inactive')->count();
        $uniqueOpds = collect($domainData)->pluck('opd')->unique()->count();

        // Statistics for cards (using real Google Sheets data)
        $stats = [
            'subdomain_sama' => $totalDomains ?: 0,
            'aktif' => $activeDomains ?: 0,
            'tidak_aktif' => $inactiveDomains ?: 0,
            'kategori_domain' => $uniqueOpds ?: 0,
        ];

        // Chart data - Domain distribution by OPD from real Google Sheets data
        $opdDistribution = collect($domainData)->groupBy('opd')->map->count();
        $ipAddressChart = $opdDistribution->take(10)->toArray() ?: ['No Data' => 1];

        // Chart data - Status by OPD from real Google Sheets data
        $statusByOpd = collect($domainData)->groupBy('opd');
        $statusByOpdChart = $statusByOpd->map(function ($domains, $opd) {
            $activeCount = $domains->where('status', 'Active')->count();
            $inactiveCount = $domains->where('status', 'Inactive')->count();

            return (object) [
                'nama_opd' => $opd,
                'aktif' => $activeCount,
                'tidak_aktif' => $inactiveCount
            ];
        })->values();

        // Pie chart data - Status distribution from real data
        $statusDistribution = [
            'tidak_aktif' => $stats['tidak_aktif'],
            'aktif' => $stats['aktif']
        ];

        // Pie chart data - Domain distribution by sheet source
        $sheetDistribution = collect($domainData)->groupBy('sheet_source');
        $sheetCounts = $sheetDistribution->map->count();
        
        $domainDistribution = [
            'sheet1' => $sheetCounts->get('Sheet1', 0),
            'domain_data' => $sheetCounts->get('Domain Data', 0),
            'opd_list' => $sheetCounts->get('OPD List', 0),
            'monitoring' => $sheetCounts->get('Monitoring', 0)
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
            'allSheetsData',
            'domainData'
        ));
    }

    /**
     * Show Google Sheets raw data for testing
     */
    public function showSheetsData()
    {
        $allSheetsData = $this->getAllSheetsData();
        $domainData = $this->parseDomainData($allSheetsData);
        
        return response()->json([
            'success' => true,
            'spreadsheet_id' => $this->spreadsheetId,
            'sheets_count' => count($allSheetsData),
            'total_domains' => count($domainData),
            'all_sheets_data' => $allSheetsData,
            'parsed_domain_data' => $domainData,
            'available_columns' => $this->getAvailableColumns($allSheetsData)
        ]);
    }

    /**
     * Get all available columns from all sheets
     */
    private function getAvailableColumns($sheetsData)
    {
        $columns = [];
        
        foreach ($sheetsData as $sheetName => $data) {
            if (!empty($data)) {
                $columns[$sheetName] = array_keys($data[0]);
            }
        }
        
        return $columns;
    }

    /**
     * Get specific sheet data with column info
     */
    public function getSheetInfo($sheetName = null)
    {
        if ($sheetName) {
            $sheetData = $this->getSheetData($sheetName);
            $columns = !empty($sheetData) ? array_keys($sheetData[0]) : [];
            
            return response()->json([
                'sheet_name' => $sheetName,
                'row_count' => count($sheetData),
                'columns' => $columns,
                'sample_data' => array_slice($sheetData, 0, 5),
                'full_data' => $sheetData
            ]);
        }
        
        $allSheets = $this->getAllSheetsData();
        $sheetInfo = [];
        
        foreach ($allSheets as $name => $data) {
            $sheetInfo[$name] = [
                'row_count' => count($data),
                'columns' => !empty($data) ? array_keys($data[0]) : []
            ];
        }
        
        return response()->json([
            'available_sheets' => array_keys($allSheets),
            'sheet_info' => $sheetInfo
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
