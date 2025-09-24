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
        // Statistics
        $stats = [
            'total_opd' => Opd::count(),
            'total_domains' => Domain::count(),
            'active_subdomains' => Domain::where('status', 'aktif')->count(),
            'inactive_subdomains' => Domain::where('status', 'tidak_aktif')->count(),
            'backup_pros' => Backup::where('type', 'pros_backup')->count(),
            'backup_selesai' => Backup::where('type', 'selesai_backup')->count(),
        ];

        // Chart data - Status Domain per OPD
        $domainsByOpd = DB::table('opd')
            ->leftJoin('domains', 'opd.id', '=', 'domains.opd_id')
            ->select(
                'opd.nama_opd',
                DB::raw('COUNT(CASE WHEN domains.status = "Aktif" THEN 1 END) as aktif'),
                DB::raw('COUNT(CASE WHEN domains.status = "Tidak Aktif" THEN 1 END) as tidak_aktif')
            )
            ->groupBy('opd.id', 'opd.nama_opd')
            ->orderBy('opd.nama_opd')
            ->get();

        // Pie chart data
        $statusDistribution = [
            'aktif' => Domain::where('status', 'Aktif')->count(),
            'tidak_aktif' => Domain::where('status', 'Tidak Aktif')->count()
        ];

        // Recent domains for table
        $recentDomains = Domain::with('opd')
            ->latest()
            ->take(10)
            ->get();

        // Backup trends
        $backupTrends = Backup::select(
            DB::raw('DATE(backup_date) as date'),
            'type',
            DB::raw('COUNT(*) as count')
        )
            ->where('backup_date', '>=', now()->subDays(30))
            ->groupBy('date', 'type')
            ->orderBy('date')
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'domainsByOpd',
            'statusDistribution',
            'recentDomains',
            'backupTrends'
        ));
    }
}
