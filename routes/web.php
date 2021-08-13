<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth login

Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');

// Auth Register

Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/register', [LoginController::class, 'create'])->name('auth.create');

// Auth Register

Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
 // Start group 

 // HOME

 Route::get('/{cat?}', [NoteController::class, 'index'])->name('home')->where('cat', '^[0-9]');

 // notes

 Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
 Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
 Route::post('/notes/destroy', [NoteController::class, 'destroy'])->name('notes.destroy');


 // Categories 

 Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
 Route::post('/categories/store', [CategoryController::class, 'store'])
  ->name('categories.store');


 // Tags 

 Route::get('/tags', [TagController::class, 'index'])->name('tags');
 Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
 // end group
});