<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
});

//CATEGORIAS
Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
Route::post('/category/create',[CategoryController::class, 'createCategory'])->name('category.create');

//USERS
Route::get('/user',[UserController::class, 'index'])->name('user.index');
Route::post('/user/create',[UserController::class, 'createUser'])->name('users.create');

//NOTES
Route::get('/note',[UserController::class, 'index'])->name('note.index');
Route::post('/user/create',[UserController::class, 'createUser'])->name('users.create');