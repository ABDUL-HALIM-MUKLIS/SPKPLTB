<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Subkriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    // public function lokasi()
    // {
    //     return $this->belongsTo(Lokasi::class, 'kode_lokasi');
    // }

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'kode_lokasi');
    }
}
