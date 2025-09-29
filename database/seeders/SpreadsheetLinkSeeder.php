<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpreadsheetLink;

class SpreadsheetLinkSeeder extends Seeder
{
    public function run()
    {
        SpreadsheetLink::create([
            'name' => 'Data OPD Purwakarta 2025',
            'url' => 'https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit',
            'sheet_id' => '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms',
            'range' => 'A:Z',
            'is_active' => true,
            'description' => 'Data lengkap OPD dan subdomain Kabupaten Purwakarta tahun 2025'
        ]);

        SpreadsheetLink::create([
            'name' => 'Backup Data Kecamatan',
            'url' => 'https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit',
            'sheet_id' => '1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms',
            'range' => 'A1:F100',
            'is_active' => false,
            'description' => 'Data backup untuk kecamatan dan domain'
        ]);
    }
}
