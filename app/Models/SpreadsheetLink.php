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
        // Note: This method now returns placeholder structure
        // In production, this should be replaced with actual Google Sheets API integration
        // using the real spreadsheet ID: 1v_IbBctN8Qqoypek8C7kj7eLnb9qSfGDrNWpZ5w1vfM

        return [
            'opd_data' => [
                // Real data will come from Google Sheets API
                // For now, return empty array to indicate no mock data
            ],
            'kecamatan_data' => [
                // Real data will come from Google Sheets API
            ],
            'summary' => [
                'total_opd' => 0,
                'total_domains' => 0,
                'active_subdomains' => 0,
                'inactive_subdomains' => 0,
                'backup_progress' => 0,
                'backup_completed' => 0,
                'backup_pending' => 0
            ]
        ];
    }
}
