<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpreadsheetLink extends Model
{
    protected $fillable = [
        'name',
        'url',
        'sheet_id',
        'range',
        'is_active',
        'description'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getGoogleSheetsData()
    {
        // Extract sheet ID from URL if not set
        if (!$this->sheet_id && $this->url) {
            preg_match('/\/spreadsheets\/d\/([a-zA-Z0-9-_]+)/', $this->url, $matches);
            if (isset($matches[1])) {
                $this->sheet_id = $matches[1];
                $this->save();
            }
        }

        // For demo purposes, return mock data
        // In production, you would integrate with Google Sheets API
        return $this->getMockData();
    }

    private function getMockData()
    {
        return [
            'opd_data' => [
                ['name' => 'BADAN KEPEGAWAIAN', 'domain_count' => 5, 'active_subdomains' => 3, 'inactive_subdomains' => 2],
                ['name' => 'BADAN KEUANGAN', 'domain_count' => 8, 'active_subdomains' => 6, 'inactive_subdomains' => 2],
                ['name' => 'DINAS PENDIDIKAN', 'domain_count' => 12, 'active_subdomains' => 10, 'inactive_subdomains' => 2],
                ['name' => 'DINAS KESEHATAN', 'domain_count' => 15, 'active_subdomains' => 12, 'inactive_subdomains' => 3],
                ['name' => 'DINAS PEKERJAAN UMUM', 'domain_count' => 10, 'active_subdomains' => 8, 'inactive_subdomains' => 2],
                ['name' => 'BAGIAN HUKUM', 'domain_count' => 6, 'active_subdomains' => 4, 'inactive_subdomains' => 2],
                ['name' => 'SEKRETARIAT DAERAH', 'domain_count' => 20, 'active_subdomains' => 18, 'inactive_subdomains' => 2],
                ['name' => 'DINAS SOSIAL', 'domain_count' => 7, 'active_subdomains' => 5, 'inactive_subdomains' => 2],
            ],
            'kecamatan_data' => [
                ['kecamatan' => 'TEGALWARU', 'domains' => [
                    ['domain' => 'BELUM MENGGUNAKAN', 'count' => 18],
                    ['domain' => 'kecamatan.purwakartakab.go.id', 'count' => 2],
                    ['domain' => 'pelayanan.purwakartakab.go.id', 'count' => 3],
                    ['domain' => 'sekolah.purwakartakab.go.id', 'count' => 5],
                ]],
                ['kecamatan' => 'PURWAKARTA', 'domains' => [
                    ['domain' => 'BELUM MENGGUNAKAN', 'count' => 15],
                    ['domain' => 'admin.purwakartakab.go.id', 'count' => 4],
                    ['domain' => 'layanan.purwakartakab.go.id', 'count' => 6],
                ]],
            ],
            'summary' => [
                'total_opd' => 48,
                'total_domains' => 228,
                'active_subdomains' => 161,
                'inactive_subdomains' => 67,
                'backup_progress' => 28,
                'backup_completed' => 20,
                'backup_pending' => 14
            ]
        ];
    }
}
