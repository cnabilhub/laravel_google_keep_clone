<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NoteController;
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


Route::get('/{cat?}', [NoteController::class, 'index'])->name('home')->where('cat', '^[0-9]');

// notes


Route::get('/notes/create', [NoteController::class, 'create'])->name('create_note');

Route::post('/notes/save', [NoteController::class, 'store'])->name('save_note');


// Categories 

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::post('/categories/save', [CategoryController::class, 'store'])->name('save_categories');


// Tags 

Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::post('/tags/create', [TagController::class, 'store'])->name('tags.store');