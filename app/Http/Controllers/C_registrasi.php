<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class C_registrasi extends Controller
{
    public function index()
    {
        return view('register/index',[
            'title' => 'Registrasi',
        ]);
    }

    
    public function store(Request $request)
    {   

        $validatedData = $request->validate([
            'name' => 'required|max:255', //contoh tanpa array
            'username' => ['required','min:3','max:255','unique:users'], //contoh mengunakan arry
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        //Cara pertama
        // $validatedData['password'] = bacrypt($validatedData['password']);

        //Cara kedua
        $validatedData['password'] = Hash::make($validatedData['password']);

        //mengirim query pada database dengan mengunakan data di atas
        User::create($validatedData);

        //Cara Pertama 
        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login');

        //Cara kedua yaitu digabung bersama redirect
        return redirect('/')->with('success', 'Registrasi Berhasil! Silahkan Login');


    }
}
