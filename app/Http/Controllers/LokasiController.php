<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
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
            // 'kode_lokasi' => 'required|max:255',
            'nama_lokasi' => 'required|max:255|unique:lokasis',
            'lat' => 'required|max:255',
            'lng' => 'required|max:255',
        ]);
        // var_dump($request->id);

        //mengirim query pada database dengan mengunakan data di atas

        Lokasi::create($validatedData);

        // DB::table('sensors')->insert([
        //     'nama_lokasi' => $request->nama_lokasi,
        // ]);


        return redirect('/sampel')->with('success', 'Berhasil Menambah Lokasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(Lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Lokasi $lokasi)
    {
        return view('dashboard/spk/editLokasi',[
            'title' => 'Edit Lokasi dan data',
            'lokasi' => $lokasi,
            'subkriteria' => Subkriteria::all()->where('kode_lokasi', $lokasi->id),
            'kriteria' => Kriteria::all()->skip(1),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        $rules = [
        ];

        


        if($request->nama_lokasi != $lokasi->nama_lokasi) {
            $rules['nama_lokasi'] =  'required|max:255|unique:lokasis';
        }

        $validatedData = $request->validate($rules);

        for($i = 0; $i < $request->jumkriteria; $i++){
            $ketir = 'namakriteria'.$i;
            $nil = 'nilai'.$i;
            DB::table('subkriterias')->where('kode_lokasi', $lokasi->id)
                                    ->where('nama_kriteria', $request->$ketir)->update(['nilai' => $request->$nil]);

        }

        Lokasi::where('id', $lokasi->id)->update($validatedData);

        return redirect('/spk')->with('success', 'Lokasi berhasil di Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // var_dump($id);
        DB::table('lokasis')->where('id', $id)->delete();

        DB::table('subkriterias')->where('kode_lokasi', $id)->delete();

        DB::table('sensors')->where('kode_lokasi', $id)->delete();

        return redirect('/kriteria')->with('success', 'Lokasi dan data sudah di Hapus !');
    }
}
