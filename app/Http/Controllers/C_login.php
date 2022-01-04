<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_login extends Controller
{
    public function index(){
        return view('login/index',[
            "title" => "Login"
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:5|max:255',
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        //jika gagal
        return back()->with('loginError', 'Login Gagal!');

    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate(); // agar sesin tidak dapat di gunakan

        $request->session()->regenerateToken(); // membuat token baru

        return redirect('/login'); // kembali kehalaman yang di tuju

    }
}
