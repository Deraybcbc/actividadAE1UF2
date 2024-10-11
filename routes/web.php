<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AutorizacionController;

Route::get('/', function () {
    return view('Login.login');
});

//CATEGORIAS
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/create', [CategoryController::class, 'createCategory'])->name('category.create');
Route::post('/category/update', [CategoryController::class, 'updateCategory'])->name('category.update');
Route::post('/category/delete', [CategoryController::class, 'deleteCategory'])->name('category.delete');

Route::post('/login', [AutorizacionController::class, 'login'])->name('login.user');

//USERS
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/create', [UserController::class, 'createUser'])->name('users.create');
Route::post('/user/update', [UserController::class, 'updateUser'])->name('users.update');
Route::post('/user/delete', [UserController::class, 'deleteUser'])->name('users.delete');

//NOTES
Route::get('/note', [NoteController::class, 'index'])->name('note.index');
Route::post('/note/create', [NoteController::class, 'createNote'])->name('note.create');
Route::post('/note/update', [NoteController::class, 'updateNote'])->name('note.update');
Route::post('/note/delete', [NoteController::class, 'deleteNote'])->name('note.delete');