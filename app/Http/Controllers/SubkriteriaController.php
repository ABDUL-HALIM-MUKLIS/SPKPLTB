<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.spk.subkriteria',[
            "subkriteria" => Subkriteria::all(),
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


        $rules = [
            // 'kode_lokasi' => 'required|max:255',
            // 'nama_kriteria' => 'required|max:255',
            'nilai' => 'required|max:255',
        ];
        

        if (Subkriteria::all()->where('kode_lokasi', $request->kode_lokasi)->where('nama_kriteria', $request->nama_kriteria)->count() == 1) {
            # code...
            // var_dump(Subkriteria::all()->where('kode_lokasi', $request->kode_lokasi)->where('nama_kriteria', $request->nama_kriteria)->count());
            $rules['kode_lokasi'] =  'required|max:255|unique:subkriterias';
            $rules['nama_kriteria'] =  'required|max:255|unique:subkriterias';
        }else {
            # code...
            // var_dump("Masuk if akhir");
            $rules['kode_lokasi'] =  'required|max:255';
            $rules['nama_kriteria'] =  'required|max:255';
        }

        $validatedData = $request->validate($rules);



        //mengirim query pada database dengan mengunakan data di atas

        Subkriteria::create($validatedData);


        return redirect('/sampel')->with('success', 'Berhasil Menambah data kriteria');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkriteria $subkriteria)
    {
        return view('/subkriteria',[
            'subkriteria' => $subkriteria,
            'kriteria' => Kriteria::all(),
            'lokasi' => Lokasi::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkriteria $subkriteria)
    {
        $this->validate($request, [
            'kode_lokasi' => 'required|max:255',
            'nama_kriteria' => 'required|max:255',
            'nilai' => 'required|max:255',
        ]);
    
        //get data Blog by ID
        $blog = Subkriteria::findOrFail($subkriteria->nama_kriteria);
    
        if($blog){
            //redirect dengan pesan sukses
            return redirect('/spk')->with('success', 'Data Berhasil Diupdate!');
        }else{
            //redirect dengan pesan error
            return redirect('/spk')->with('error', 'Data Gagal Diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkriteria $subkriteria)
    {
        //
    }
}
