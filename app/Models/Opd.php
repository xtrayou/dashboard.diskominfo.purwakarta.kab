<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'opd';
    protected $fillable = ['no_opd', 'nama_opd', 'kecamatan'];

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
