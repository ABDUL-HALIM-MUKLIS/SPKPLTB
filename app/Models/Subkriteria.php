<?php

namespace App\Models;

use App\Models\Lokasi;
use App\Models\Kriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subkriteria extends Model
{
    use HasFactory;
    
    protected $guarded =[
        'id'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kode_lokasi');
    }
    
    public function lokasi()
    {
        return $this->hasMany(Lokasi::class, 'kode_lokasi');
    }
}
