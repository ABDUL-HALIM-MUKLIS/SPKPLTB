<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function wa()
    {
        // $sid    = getenv("AGi8DgnxfLmfRpV52swENuuo1cVkEP4r5q");
        // $token  = getenv("5038c14ca941d659a235fa8345ea7754");
        // $wa_from= getenv("14155238886");
        // $twilio = new Client($sid, $token);
        
        // $body = "Hello, welcome to SKRIPSI";
        // var_dump($twilio);
        // return $twilio->messages->create("whatsapp:6285843233369",["from" => "whatsapp:$wa_from", "body" => $body]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_lokasi' => 'required|max:255',
            'anemometer' => 'required|max:255',
            'tilt' => 'required|max:255',
        ]);

        //mengirim query pada database dengan mengunakan data di atas
        Sensor::create($validatedData);

        // return "Berhasil Menambah"
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sensor $sensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sensor $sensor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sensor  $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        //
    }
}
