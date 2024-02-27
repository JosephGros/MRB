<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('admin')->group(function (){
// Only admin routes 
});

Route::middleware(['admin', 'moderator'])->group(function (){
// Only admin and moderator routes

//Movie Routes
Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movie.index');
Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('admin.movie.create');
Route::post('/admin/movies', [MovieController::class, 'store'])->name('admin.movie.store');
Route::get('/admin/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
Route::patch('/admin/movies/{movie}/update', [MovieController::class, 'update'])->name('admin.movie.update');
Route::delete('/admin/movies/{movie}/delete', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

//Series Routes
Route::get('/series/overview', [SerieController::class, 'index'])->name('series.index');
Route::get('/series/create', [SerieController::class, 'create'])->name('series.create');
Route::post('/series', [SerieController::class, 'store'])->name('series.store');
Route::get('/series/{id}/edit', [SerieController::class, 'edit'])->name('series.edit');
Route::patch('/series/{id}/update', [SerieController::class, 'update'])->name('series.update');
Route::delete('/series/{id}/delete', [SerieController::class, 'delete'])->name('series.delete');

});

Route::middleware(['admin', 'moderator', 'auth'])->group(function (){
// Routes for CRUD for users own creations and moderators admins can play God!
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Display view Routes for Movies and Series
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');

// Kontaktformulär Routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index']);


//About us controller Route
Route::get('/about-us', [App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us');


require __DIR__.'/auth.php';