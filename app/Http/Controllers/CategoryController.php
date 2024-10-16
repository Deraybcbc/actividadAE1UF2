<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('idUser', Auth::user()->id)->get();
        return view('Categoria.categoria', compact('categories'));
    }

    public function createCategory(Request $request)
    {
        $date = $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name' => 'El campo nombre es obligatorio'
            ]
        );

        $category = new Category();
        $category->idUser = Auth::user()->id;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Categoría creada correctamente.');
        //return response()->json(['status' => 'success', 'category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        $date = $request->validate(
            [
                'name' => 'required'
            ],
            [
                'name' => 'No puede estar vacio este campo'
            ]
        );

        //PARA IMPRIMIR
        //dd($request);

        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => "Categoria no encontrado"], 404);
        }

        $category->name = $request->name;
        $category->save();

        //return response()->json(['status' => 'success', 'category' => $category]);
        return redirect()->route('category.index')->with('success', 'Categoría actualizada.');
    }

    public function deleteCategory($id)
    {
        $notes = Note::where('idCategory', $id)->get();

        foreach ($notes as $note) {
            $note->delete();
        }

        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Categoría eliminada.');
    }
}
