<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
            $user = Auth::user();

            $token = $user->createToken('auth-token')->plainTextToken;
            session(['auth-token', $token]);
            //return response()->json(["success"=>"exito"]);
            return redirect()->route('category.index');
            //return redirect()->intended('category');
        }

        return back()->withErrors(['email'=> 'Correo o contraseña no son correctas'])->onlyInput('email');
    }

    public function screenRegister (){ 
        return view('Login.register');
    }

    public function register(Request $request){

        $credenciales = $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password'=> 'required',
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        $token = $user->createToken('auth-token')->plainTextToken;
        session(['auth-token', $token]);

        // Log the user in
        Auth::login($user);

        //$request->session()->regenerate();
        
        return redirect()->route('category.index');
        
    }
    

    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }
}
