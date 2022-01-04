<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Sensor;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class C_sampel extends Controller
{
    public function index($request = null)
    {


        return view('dashboard.sampel.index',[
            'title' => 'Sampel',
            "lokasi" => Lokasi::all(),
            "sensorall" => Sensor::all()->where('kode_lokasi', 1),
            "sensoralltabel" => Sensor::all()->where('kode_lokasi', 1)->reverse(),
            "sensorpage" => Sensor::latest()->paginate(10),
            "sensor" => Sensor::latest()->paginate(10),
            "kriteria" => Kriteria::all(),
            "kemiringan" => Sensor::all()->last(),
        ]);
    }

    public function post(Request $request)
    {
        return view('dashboard.sampel.index',[
            'title' => 'Sampel',
            "lokasi" => Lokasi::all(),
            // "sensor" => Sensor::latest(),
            "kriteria" => Kriteria::all(),
            "kemiringan" => Sensor::all()->where('kode_lokasi', $request->lokasi)->last(),
            "sensorall" => Sensor::all()->where('kode_lokasi', $request->lokasi),
            "sensoralltabel" => Sensor::all()->where('kode_lokasi', $request->lokasi)->reverse(),
            // "sensorpage" => Sensor::where('kode_lokasi', $request->lokasi)->latest()->paginate(10),
            "sensorpage" => Sensor::where('kode_lokasi', $request->lokasi)->latest(),
            
        ]);
    }
}
