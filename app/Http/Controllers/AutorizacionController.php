<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutorizacionController extends Controller
{
    public function index(){
        return view("");
    }

    public function login(Request $request){

        
        $credenciales = $request->validate([
            "email"=> ["required", "email"],
            "password"=> "required",
        ]);

        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();
            //return response()->json(["success"=>"exito"]);
            return redirect()->intended('category');
        }

        return back()->withErrors(['email'=> 'Correo o contraseña no son correctas'])->onlyInput('email');
    }
}
