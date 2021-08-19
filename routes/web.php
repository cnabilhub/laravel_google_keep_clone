<!-- <?php

     use Illuminate\Support\Facades\Route;
     use App\Http\Controllers\TagController;
     use App\Http\Controllers\NoteController;
     use App\Http\Controllers\UserController;
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

     Route::get('/login', [UserController::class, 'index'])->name('auth.login');
     Route::post('/login', [UserController::class, 'authenticate'])->name('auth.authenticate');
     Route::get('/register', [UserController::class, 'register'])->name('auth.register');


     // Auth Register

     Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
     Route::middleware(['auth'])->group(function () {
          // Start group 


          // notes

          Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
          Route::post('/notes/store', [NoteController::class, 'store'])->name('notes.store');
          Route::post('/notes/destroy', [NoteController::class, 'destroy'])->name('notes.destroy');


          // Categories 

          Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
          Route::get('/categories/list', [CategoryController::class, 'getCategories'])
               ->name('categories.list');
          Route::post('/categories/store', [CategoryController::class, 'store'])
               ->name('categories.store');


          // Tags 

          Route::get('/tags', [TagController::class, 'index'])->name('tags');
          Route::post('/tags/store', [TagController::class, 'store'])->name('tags.store');
          Route::get('/tags/list', [TagController::class, 'getTags'])->name('tags.list');


          // settings 
          Route::get('/user/settings', [UserController::class, 'settings'])->name('auth.settings');
          Route::post('/settings/update', [UserController::class, 'updatesetting']);


          // HOME

          Route::get('/categories/{cat?}', [NoteController::class, 'index'])->name('home2')->where('cat', '^[0-9]');

          // end group
     });