<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        return view("Note/notas");
    }

    public function createNote(Request $request)
    {
        $data = $request->validate(
            [
                'idCategory' => 'required',
                'title' => 'required',
                'desc' => 'required'
            ],
            [
                'idCategory' => 'Campo necesario',
                'title' => 'Campo necesario',
                'desc' => 'Campo necesario'
            ]
        );

        $note = new Note();
        $note->idCategory = $request->idCategory;
        $note->title = $request->title;
        $note->desc = $request->desc;

        $note->save();

        return response()->json(['status' => 'succees', 'notes' => $note]);
    }
    public function updateNote(Request $request)
    {
        $data = $request->validate(
            [
                'idCategory' => 'required',
                'title' => 'required',
                'desc' => 'required'
            ],
            [
                'idCategory' => 'Campo necesario',
                'title' => 'Campo necesario',
                'desc' => 'Campo necesario'
            ]
        );

        $note = Note::find($request->id);

        if (!$note) {
            return response()->json(['status' => 'error', 'message' => 'No encontrado']);
        }

        $note->title = $request->title;
        $note->desc = $request->desc;
        $note->save();

        return response()->json(['status' => 'success', 'note' => $note]);
    }

    public function deleteNote(Request $request)
    {
        $note = Note::find($request->id);

        if (!$note) {
            return response()->json(['status' => 'error', 'message' => 'No encontrado']);
        }

        $note->delete();
        return response()->json(['status' => 'success', 'note' => $note]);
    }
}
