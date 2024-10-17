<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AutorizacionController;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::middleware('auth:sanctum')->group(function () {

    //NOTES
    Route::prefix('/note')->group(function () {
        Route::get('/{id}', [NoteController::class, 'show'])->name('notes.show');
        Route::post('/create/{id}', [NoteController::class, 'createNote'])->name('note.create');
        Route::post('/update/{id}', [NoteController::class, 'updateNote'])->name('note.update');
        Route::delete('/delete/{id}', [NoteController::class, 'deleteNote'])->name('note.delete');
    });

    //CATEGORY
    Route::prefix('/category')->group(function () {
        
        Route::post('/create', [CategoryController::class, 'createCategory'])->name('category.create');
        Route::post('/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    });
        
});

