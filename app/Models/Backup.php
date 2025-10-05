<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id',
        'type',
        'backup_date'
    ];

    protected $casts = [
        'backup_date' => 'date'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
