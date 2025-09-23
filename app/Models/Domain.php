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
        'completion_date' => 'date'
    ];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function backups()
    {
        return $this->hasMany(Backup::class);
    }
}
