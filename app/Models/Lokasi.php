<?php

namespace App\Models;

use App\Models\Sensor;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;
    // protected $fillable = ['kode_lokasi ','nama_lokasi','created_at','updated_at'];
    protected $guarded =['id'];
    public function sensor()
    {
        return $this->hasMany(Sensor::class , 'kode_lokasi');
    }

    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class, 'kode_lokasi');
    }
}
