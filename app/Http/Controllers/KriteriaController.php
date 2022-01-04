<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Sensor;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.spk.index',[
            'title' => 'SPK',
            "kriteria" => Kriteria::all(),
            "sensor" => Sensor::all(),
            "lokasi" => Lokasi::all(),
            "subkriteria" => Subkriteria::all(),
            // dd(Sensor::unique('kode_lokasi'))
        ]);
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
            'nama_kriteria' => 'required|max:255|unique:kriterias',
            'bobot' => 'required|max:255',
            // 'jenis_data' => 'required|max:255',
            'keterangan_data' => 'required|max:255',
        ]);

        $loki = ["lokasi" => Lokasi::all(),];

        // var_dump();
        // $inputan = $request->input('jenis_data');

        // mengirim query pada database dengan mengunakan data di atas
        Kriteria::create($validatedData);

        
        return redirect('/sampel')->with('success', 'Berhasil Menambah Kriteria');
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // var_dump(Kriteria::all()->where('nama_kriteria', $nama_kriteria));
        return view('dashboard.spk.editKriteria', [
            'title' => 'Edit Kriteria',
            'kriteria' => Kriteria::all()->where('id', $id)->first(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kriteria $kriteria)
    {
        // var_dump($request->nama_kriteria);

        $rules = [
            // 'nama_kriteria' => 'required|max:255|unique:kriterias',
            'bobot' => 'required|max:255',
            // 'jenis_data' => 'required|max:255',
            'keterangan_data' => 'required|max:255',
        ];

        if(!Kriteria::all()->where('nama_kriteria', $request->nama_kriteria)->first()){
            $rules['nama_kriteria'] = 'required|max:255|unique:kriterias';
        }
    
        $validatedData = $request->validate($rules);

        DB::table('subkriterias')->where('nama_kriteria', $request->kriterialama)->update(['nama_kriteria' => $request->nama_kriteria]);

        Kriteria::where('id', $request->id)
                ->update($validatedData);


        return redirect('/spk')->with('success', 'Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($nama_kriteria)
    {

        DB::table('kriterias')->where('nama_kriteria', $nama_kriteria)->delete();

        DB::table('subkriterias')->where('nama_kriteria', $nama_kriteria)->delete();

        return redirect('/kriteria')->with('success', 'Kriteria sudah di Hapus !');
    }

    public function checkSlug(Request $request)
    {
        var_dump('coba');
        // $nama_kriteria = SlugService::createSlug(Kriteria::class, 'nama_kriteria', $request->nama_kriteria);
        // return response()->json(['nama_kriteria'=> $nama_kriteria]);
    }
}
