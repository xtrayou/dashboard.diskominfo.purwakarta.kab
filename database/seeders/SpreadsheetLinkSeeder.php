<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SpreadsheetLink;

class SpreadsheetLinkSeeder extends Seeder
{
    public function run()
    {
        // Clear existing dummy data
        SpreadsheetLink::truncate();

        // Add new real spreadsheet data
        SpreadsheetLink::create([
            'name' => 'Data OPD dan Subdomain Purwakarta 2025 - Real Data',
            'url' => 'https://docs.google.com/spreadsheets/d/1v_IbBctN8Qqoypek8C7kj7eLnb9qSfGDrNWpZ5w1vfM/edit?gid=1869603133#gid=1869603133',
            'sheet_id' => '1v_IbBctN8Qqoypek8C7kj7eLnb9qSfGDrNWpZ5w1vfM',
            'range' => 'A:Z',
            'is_active' => true,
            'description' => 'Data resmi OPD dan subdomain Kabupaten Purwakarta tahun 2025 dari Diskominfo'
        ]);
    }
}
