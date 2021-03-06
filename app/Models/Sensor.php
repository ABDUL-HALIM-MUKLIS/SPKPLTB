<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $guarded =[
        'id'
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'kode_lokasi');
    }

}
