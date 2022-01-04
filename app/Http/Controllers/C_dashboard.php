<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Sensor;
use Illuminate\Http\Request;

class C_dashboard extends Controller
{
    public function index()
    {
        if(request('lokasi')){
            $sensor = Sensor::firstWhere('nama_lokasi', request('lokasi'));
        }


        return view('dashboard.index',[
            
            'title' => 'Dashboard',
            // "sensor" => Sensor::latest()->paginate(15),
            "sensor" => Sensor::all()->reverse(),
            "lokasi" => Lokasi::all(),
        ]);
    }
}
