<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AutorizacionController;

Route::get('/', function () {
    return view('Login.login');
});
/*
//CATEGORIAS
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/create', [CategoryController::class, 'createCategory'])->name('category.create');
Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');*/

//LOGIN
Route::post('/login', [AutorizacionController::class, 'login'])->name('login.user');
Route::get('/login/logout', [AutorizacionController::class, 'logout'])->name('login.logout');

//REGISTER
Route::get('/login/screenregister', [AutorizacionController::class, 'screenRegister'])->name('login.screenRegister');
Route::post('/register', [AutorizacionController::class, 'register'])->name('login.register');

/*
//USERS
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user/create', [UserController::class, 'createUser'])->name('users.create');
Route::post('/user/update', [UserController::class, 'updateUser'])->name('users.update');
Route::post('/user/delete', [UserController::class, 'deleteUser'])->name('users.delete');

//NOTES
// web.php
Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::post('/note/create/{id}', [NoteController::class, 'createNote'])->name('note.create');
Route::post('/note/update/{id}', [NoteController::class, 'updateNote'])->name('note.update');
Route::delete('/note/delete/{id}', [NoteController::class, 'deleteNote'])->name('note.delete');*/


// Routes protected by the 'auth' middleware
Route::middleware(['auth'])->group(function () {
    // CATEGORIES
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create', [CategoryController::class, 'createCategory'])->name('category.create');
    Route::post('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    // USERS
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/create', [UserController::class, 'createUser'])->name('users.create');
    Route::post('/user/update', [UserController::class, 'updateUser'])->name('users.update');
    Route::post('/user/delete', [UserController::class, 'deleteUser'])->name('users.delete');

    // NOTES
    Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::post('/note/create/{id}', [NoteController::class, 'createNote'])->name('note.create');
    Route::post('/note/update/{id}', [NoteController::class, 'updateNote'])->name('note.update');
    Route::delete('/note/delete/{id}', [NoteController::class, 'deleteNote'])->name('note.delete');
});