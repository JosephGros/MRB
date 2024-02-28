<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserListContentController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\WriterController;
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

Route::get('/dashboard', [GenreController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Only admin routes
Route::middleware('admin')->group(function (){
//User view
Route::get('/admin/users', [AdminController::class, 'admin'])->name('admin.only');

});

// Only admin and moderator routes
Route::middleware(['admin', 'moderator'])->group(function (){

    //Admin and Moderator Routes
    Route::get('/admin/users', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/movies', [AdminController::class, 'store'])->name('admin.movie.store');

    //Movie Routes
    Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movie.index');
    Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/admin/movies', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::get('/admin/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::patch('/admin/movies/{movie}/update', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('/admin/movies/{movie}/delete', [MovieController::class, 'destroy'])->name('admin.movie.destroy');

    //Series Routes
    Route::get('/admin/series', [SerieController::class, 'index'])->name('admin.series.index');
    Route::get('/admin/series/create', [SerieController::class, 'create'])->name('admin.series.create');
    Route::post('/admin/series', [SerieController::class, 'store'])->name('admin.series.store');
    Route::get('/admin/series/{series}/edit', [SerieController::class, 'edit'])->name('admin.series.edit');
    Route::patch('/admin/series/{series}/update', [SerieController::class, 'update'])->name('admin.series.update');
    Route::delete('/admin/series/{series}/delete', [SerieController::class, 'destroy'])->name('admin.series.destroy');

    //Actor Routes
    Route::get('/admin/actors', [ActorController::class, 'index'])->name('admin.actors.index');
    Route::get('/admin/actors/create', [ActorController::class, 'create'])->name('admin.actors.create');
    Route::post('/admin/actors', [ActorController::class, 'store'])->name('admin.actors.store');
    Route::get('/admin/actors/{actor}/edit', [ActorController::class, 'edit'])->name('admin.actors.edit');
    Route::patch('/admin/actors/{actor}/update', [ActorController::class, 'update'])->name('admin.actors.update');
    Route::delete('/admin/actors/{actor}/delete', [ActorController::class, 'destroy'])->name('admin.actors.destroy');

    //Director Routes
    Route::get('/admin/directors', [DirectorController::class, 'index'])->name('admin.directors.index');
    Route::get('/admin/directors/create', [DirectorController::class, 'create'])->name('admin.directors.create');
    Route::post('/admin/directors', [DirectorController::class, 'store'])->name('admin.directors.store');
    Route::get('/admin/directors/{director}/edit', [DirectorController::class, 'edit'])->name('admin.directors.edit');
    Route::patch('/admin/directors/{director}/update', [DirectorController::class, 'update'])->name('admin.directors.update');
    Route::delete('/admin/directors/{director}/delete', [DirectorController::class, 'destroy'])->name('admin.directors.destroy');

    //Creator Routes
    Route::get('/admin/creators', [CreatorController::class, 'index'])->name('admin.creators.index');
    Route::get('/admin/creators/create', [CreatorController::class, 'create'])->name('admin.creators.create');
    Route::post('/admin/creators', [CreatorController::class, 'store'])->name('admin.creators.store');
    Route::get('/admin/creators/{creator}/edit', [CreatorController::class, 'edit'])->name('admin.creators.edit');
    Route::patch('/admin/creators/{creator}/update', [CreatorController::class, 'update'])->name('admin.creators.update');
    Route::delete('/admin/creators/{creator}/delete', [CreatorController::class, 'destroy'])->name('admin.creators.destroy');

    //Writer Routes
    Route::get('/admin/writers', [WriterController::class, 'index'])->name('admin.writers.index');
    Route::get('/admin/writers/create', [WriterController::class, 'create'])->name('admin.writers.create');
    Route::post('/admin/writers', [WriterController::class, 'store'])->name('admin.writers.store');
    Route::get('/admin/writers/{writer}/edit', [WriterController::class, 'edit'])->name('admin.writers.edit');
    Route::patch('/admin/writers/{writer}/update', [WriterController::class, 'update'])->name('admin.writers.update');
    Route::delete('/admin/writers/{writer}/delete', [WriterController::class, 'destroy'])->name('admin.writers.destroy');


    //Genre Routes
    Route::get('/admin/genres/create', [GenreController::class, 'create'])->name('admin.genres.create');
    Route::post('/admin/genres', [GenreController::class, 'store'])->name('admin.genres.store');
    Route::get('/admin/genres/{genre}/edit', [GenreController::class, 'edit'])->name('admin.genres.edit');
    Route::patch('/admin/genres/{genre}/update', [GenreController::class, 'update'])->name('admin.genres.update');
    Route::delete('/admin/genres/{genre}/delete', [GenreController::class, 'destroy'])->name('admin.genres.destroy');

});

// Route::middleware()->group(function (){
// // Routes for CRUD for users own creations and moderators admins can play God!
// });

//ROUTES FOR ALL VIEWS AND STUFF YOU NEED TO BE LOGGED IN FOR.

Route::middleware(['admin', 'moderator', 'auth'])->group(function () {

    //CRUD Rating Routes
    Route::post('/display/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::patch('/display/ratings/{rating}/update', [RatingController::class, 'update'])->name('ratings.update');
    Route::delete('/display/ratings/{rating}/delete', [RatingController::class, 'destroy'])->name('ratings.destroy');

    //CRUD Review Routes
    Route::post('/display/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/display/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::get('/display/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/display/reviews/{review}/update', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/display/reviews/{review}/delete', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    //Everything for user lists and watchlist
    //Watchlist  ->middleware(['auth', 'verified'])
    Route::get('/watchlist/all/{user}', [WatchlistController::class, 'index'])->name('watchlist.index'); //To se everything in watchlist
    Route::get('/watchlist/{user}', [WatchlistController::class, 'dashboardWatchlist'])->name('watchlist.dashboardWatchlist'); //Watchlist for Dashboard
    Route::post('/watchlist/add/{user}', [WatchlistController::class, 'store'])->name('watchlist.store'); //Watchlist+ button
    Route::delete('/watchlist/delete/{user}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy'); //Watchlist- button
    //User Lists
    Route::get('/userlists/{user}', [UserListController::class, 'index'])->name('userlists.index'); //To get all the users lists with content for profile
    Route::get('/userlists/list/{user}', [UserListController::class, 'show'])->name('userlists.show'); //Views that list with all content
    Route::post('/userlists/create/{user}', [UserListController::class, 'store'])->name('userlists.store'); //Create new list button
    Route::patch('/userlists/update/{user}', [UserListController::class, 'update'])->name('userlists.update'); //Update list name
    Route::delete('/userlists/delete/{user}', [UserListController::class, 'destroy'])->name('userlists.destroy'); //Userlists- button
    //UserListContent
    Route::get('/userListContent/{user}', [UserListContentController::class, 'index'])->name('userListContent.index'); //All lists displayed for the user to add content to one or several lists
    Route::post('/userListContent/create/{user}', [UserListContentController::class, 'store'])->name('userListContent.store'); //Add button will be displayed if not in list
    Route::delete('/userListContent/delete/{user}', [UserListContentController::class, 'destroy'])->name('userListContent.destroy'); //Remove button will be displayed if it exists in the list

    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//ROUTES FOR DISPLAYING IN DIFFERENT VIEWS FOR ALL THAT ENTERS THE WEBSITE.

//Display view Routes for 1 Movie or 1 Series
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movie.show');
Route::get('/series/{serie}', [SerieController::class, 'show'])->name('serie.show');
//Side views from Display
Route::get('/reviews', [ReviewController::class, 'show'])->name('review.show');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
//RANDOM 3 at start
Route::get('/dashboard/random', [GenreController::class, 'randomDashboard'])->name('genres.randomDashboard');


//Dashboard Routes for all to see. (Fetching Genres with movies and series)
// Route::get('/dashboard/genres', [GenreController::class, 'index'])->name('genres.index');


//View for seing everything in the specific genre
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');


// Kontaktformulär Routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index']);


//About us controller Route
Route::get('/about-us', [App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us');


require __DIR__.'/auth.php';