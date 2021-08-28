<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;



// Auth login

Route::get('/login', [UserController::class, 'index'])->name('auth.login');
Route::post('/login', [UserController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [UserController::class, 'register'])->name('auth.register');
Route::post('/register', [UserController::class, 'create'])->name('auth.create');
Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');


Route::middleware(['auth'])->group(function () {
     // Start group  with auth middlewear


     // HOME
     Route::get('/{cat?}/{term?}', [NoteController::class, 'index'])->name('home')->where('cat', '[0-9]+');

     // notes
     Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
     Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
     Route::delete('/notes/destroy', [NoteController::class, 'destroy'])->name('notes.destroy');
     Route::get('/notes/{id}/', [NoteController::class, 'show'])->name('notes.show')->where('id', '[0-9]+');

     Route::get('/notes/edit/{id}', [NoteController::class, 'edit'])->name('notes.edit')->where('id', '[0-9]+');

     Route::post('/notes/update/{id}', [NoteController::class, 'update'])->name('notes.update')->where('id', '[0-9]+');


     // Categories 
     Route::get('/categories/all', [CategoryController::class, 'index'])->name('categories');
     Route::get('/categories/list', [CategoryController::class, 'getCategories'])->name('categories.list');
     Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');

     Route::delete('/categories/{id?}', [CategoryController::class, 'destroy'])->name('categories.destroy')->where('id', '[0-9]+');

     Route::get('/categories/ajax/{id?}', [CategoryController::class, 'getCategory'])->name('getCategory.ajax')->where('id', '[0-9]+');

     Route::put('/categories/update/ajax/{id?}', [CategoryController::class, 'update'])->name('category.update')->where('id', '[0-9]+');


     // Tags 
     Route::get('/tags', [TagController::class, 'index'])->name('tags');
     Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
     Route::get('/tags/list', [TagController::class, 'getTags'])->name('tags.list');


     // settings 
     Route::get('/user/settings', [UserController::class, 'settings'])->name('auth.settings');
     Route::put('/settings/update', [UserController::class, 'updatesetting'])->name('updatesetting');
});