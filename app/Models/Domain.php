<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_id',
        'domain_name',
        'subdomain',
        'status',
        'backup_date',
        'completion_date'
    ];

    protected $casts = [
        'backup_date' => 'date',
        'completion_date' => 'date',
        'status' => 'string'
    ];

    const STATUS_AKTIF = 'Aktif';
    const STATUS_TIDAK_AKTIF = 'Tidak Aktif';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_AKTIF,
            self::STATUS_TIDAK_AKTIF
        ];
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function backups()
    {
        return $this->hasMany(Backup::class);
    }
}
