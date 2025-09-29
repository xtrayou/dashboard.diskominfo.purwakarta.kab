<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Opd;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics for cards
        $stats = [
            'subdomain_sama' => Domain::count() ?: 724,
            'aktif' => Domain::where('status', 'Aktif')->count() ?: 367,
            'tidak_aktif' => Domain::where('status', 'Tidak Aktif')->count() ?: 354,
            'kategori_domain' => Opd::count() ?: 2,
        ];

        // Chart data - Jumlah Ip Subdomain yang sama menurut IP ADDRESS
        $ipAddressChart = [
            '216.244.84.196' => 300,
            '216.244.84.194' => 280,
            '103.133.27.164' => 25,
            '103.133.27.212' => 20,
            '103.133.27.213' => 15,
            '103.133.27.214' => 10,
            '103.133.27.215' => 8,
            '103.133.27.216' => 5,
            '103.133.27.217' => 3,
            '103.133.27.218' => 2,
            '216.244.84.197' => 1,
        ];

        // Chart data - Distribusi Subdomain Berdasarkan Status by OPD
        $statusByOpdChart = DB::table('opd')
            ->leftJoin('domains', 'opd.id', '=', 'domains.opd_id')
            ->select(
                'opd.nama_opd',
                DB::raw('COUNT(CASE WHEN domains.status = "Aktif" THEN 1 END) as aktif'),
                DB::raw('COUNT(CASE WHEN domains.status = "Tidak Aktif" THEN 1 END) as tidak_aktif')
            )
            ->groupBy('opd.id', 'opd.nama_opd')
            ->orderBy('opd.nama_opd')
            ->get();

        // Pie chart data - Persentase Status
        $statusDistribution = [
            'tidak_aktif' => $stats['tidak_aktif'],
            'aktif' => $stats['aktif']
        ];

        // Pie chart data - Persentase Domain
        $domainDistribution = [
            'tidak_aktif' => $stats['tidak_aktif'],
            'aktif' => $stats['aktif'],
            'local' => Domain::where('domain_name', 'like', '%local%')->count() ?: 50
        ];

        // Category table data
        $categoryData = [
            ['source' => 'INDOLUS', 'status' => 'TIDAK AKTIF', 'record' => 200],
            ['source' => 'INDOLUS', 'status' => 'AKTIF', 'record' => 205],
            ['source' => 'LOCAL', 'status' => 'TIDAK AKTIF', 'record' => 46],
            ['source' => 'LOCAL', 'status' => 'AKTIF', 'record' => 24],
        ];

        // IP Address table data
        $ipAddressData = [
            ['ip' => '216.244.84.196', 'aktif' => 1, 'tidak_aktif' => 1],
            ['ip' => '216.244.84.194', 'aktif' => 1, 'tidak_aktif' => 1],
            ['ip' => 'Tidak Manual', 'aktif' => 1, 'tidak_aktif' => 0],
            ['ip' => '103.133.27.164', 'aktif' => 1, 'tidak_aktif' => 0],
            ['ip' => '103.133.27.212', 'aktif' => 0, 'tidak_aktif' => 1],
        ];

        return view('dashboard', compact(
            'stats',
            'ipAddressChart',
            'statusByOpdChart',
            'statusDistribution',
            'domainDistribution',
            'categoryData',
            'ipAddressData'
        ));
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

        return view('health-monitoring', compact('healthStats', 'domainHealth'));
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

        return view('subdomain-status', compact('subdomainStats', 'opdData', 'kecamatanData', 'activeSpreadsheet'));
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

        return view('server-infrastructure', compact('serverStats', 'servers'));
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

        return view('realtime-monitoring', compact('realtimeStats', 'recentActivities', 'systemAlerts'));
    }
}
