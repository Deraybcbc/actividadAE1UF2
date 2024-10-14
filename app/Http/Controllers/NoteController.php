<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(Request $request)
    {

        return view("Note/notas");
    }


    // NoteController.php
    public function show($id)
    {
        $note = Note::find($id);

        if (!$note) {
            return redirect()->route('notes.show')->with('error', 'Nota no encontrada.');
        }

        return view('Note/notas', compact('note'));
    }


    public function createNote(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required',
                'desc' => 'required'
            ],
            [
                'title' => 'Campo necesario',
                'desc' => 'Campo necesario'
            ]
        );

        $note = new Note();
        $note->idCategory = $id;
        $note->title = $request->title;
        $note->desc = $request->desc;

        $note->save();

        return redirect()->route('category.index')->with('success', 'Nota creada correctamente.');
        //return response()->json(['status' => 'succees', 'notes' => $note]);
    }
    public function updateNote(Request $request, $id)
    {
        $data = $request->validate(
            [
                'title' => 'required',
                'desc' => 'required'
            ],
            [
                
                'title' => 'Campo necesario',
                'desc' => 'Campo necesario'
            ]
        );

        $note = Note::find($id);

        if (!$note) {
            return response()->json(['status' => 'error', 'message' => 'No encontrado']);
        }

        $note->title = $request->title;
        $note->desc = $request->desc;
        $note->save();

        return redirect()->route('category.index')->with('success', 'Nota creada correctamente.');
    }

    public function deleteNote($id)
    {
        $note = Note::findOrFail($id);
   
        $note->delete();

        return redirect()->route('category.index')->with('success', 'Nota eliminada.');
    }
}
