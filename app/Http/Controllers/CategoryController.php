<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('Categoria.categoria');
    }

    public function createCategory(Request $request)
    {
        $date = $request->validate(
            [
                'idUser' => 'required',
                'name' => 'required'
            ],
            [
                'idUser' => 'El campo idUser es obligatorio',
                'name' => 'El campo nombre es obligatorio'
            ]
        );

        $category = new Category();
        $category->idUser = $request->idUser;
        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => 'success', 'category' => $category]);
    }

    public function updateCategory(Request $request)
    {
        $date = $request->validate(
            [
                'idUser' => 'required',
                'name' => 'required'
            ],
            [
                'idUser' => 'Este campo es necesario',
                'name' => 'No puede estar vacio este campo'
            ]
        );

        $category = Category::find($request->id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => "Usuario no encontrado"], 404);
        }

        $category->name = $request->name;
        $category->save();

        return response()->json(['status' => 'success', 'category' => $category]);
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => "Usuario no encontrado"], 404);
        }

        $category->delete();

        return response()->json(['status' => 'success', 'category' => $category]);
    }
}
