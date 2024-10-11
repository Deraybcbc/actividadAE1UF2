<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('Users/user');
    }

    public function createUser(Request $request){
        $date = $request->validate(
            [
                'name'=>'required',
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'name.required'=>'El campo name es obligatorio',
                'email.required'=>'El campo name es obligatorio',
                'password.required'=>'El campo name es obligatorio'
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return response()->json(['status'=> 'success','user'=> $user]);
    }

    public function updateUser(Request $request){
        $date = $request->validate(
            [
                'id'=>'required',
                'name'=> 'required',
                'email'=> 'required',
                'password'=> 'required'
            ],
            [
                'name'=> 'Campo necesario',
                'email'=>'Campo necesario',
                'password'=> 'Campo necesario'
            ]);
            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();

            return response()->json(['status'=> 'success','user'=> $user]);
        }
        public function deleteUser(Request $request){
            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Usuario no encontrado'], 404);
            }
            
            $user->delete();
            return response()->json(['status'=> 'success','user'=> $user]);
        }
}