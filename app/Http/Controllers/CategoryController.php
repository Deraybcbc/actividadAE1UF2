<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
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

    public function deleteCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['status' => 'error', 'message' => "Categoría no encontrada"], 404);
        }

        if ($category->notes->isNotEmpty()) {
            return redirect()->route('category.index')->with('error', 'La categoría no se puede eliminar porque contiene notas.');
        }

        $category->delete();


        return redirect()->route('category.index')->with('success', 'Categoría eliminada.');
    }
}
