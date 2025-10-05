<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample OPDs
        \App\Models\Opd::create([
            'no_opd' => 1,
            'nama_opd' => 'Dinas Komunikasi dan Informatika',
            'kecamatan' => 'TEGALWARU'
        ]);

        \App\Models\Opd::create([
            'no_opd' => 2,
            'nama_opd' => 'Sekretariat Daerah',
            'kecamatan' => 'TEGALWARU'
        ]);

        \App\Models\Opd::create([
            'no_opd' => 3,
            'nama_opd' => 'Dinas Pendidikan',
            'kecamatan' => 'TEGALWARU'
        ]);

        // Create sample domains
        $opds = \App\Models\Opd::all();

        foreach ($opds as $opd) {
            // Active domains
            for ($i = 1; $i <= 10; $i++) {
                \App\Models\Domain::create([
                    'domain_name' => 'purwakartakab.go.id',
                    'subdomain' => 'opd' . $opd->no_opd . '-' . $i,
                    'opd_id' => $opd->id,
                    'status' => 'Aktif',
                    'backup_date' => now()->subDays(rand(1, 30)),
                    'completion_date' => now()->subDays(rand(1, 15))
                ]);
            }

            // Inactive domains  
            for ($i = 11; $i <= 15; $i++) {
                \App\Models\Domain::create([
                    'domain_name' => 'purwakartakab.go.id',
                    'subdomain' => 'opd' . $opd->no_opd . '-' . $i,
                    'opd_id' => $opd->id,
                    'status' => 'Tidak Aktif',
                    'backup_date' => null,
                    'completion_date' => null
                ]);
            }
        }
    }
}
