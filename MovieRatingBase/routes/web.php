<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UserListContentController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserProfileController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Only admin routes
Route::middleware('admin')->group(function (){
//User view
Route::get('/admin/users', [AdminController::class, 'adminAll'])->name('admin.users.all'); //Get all users in created latest order
Route::get('/admin/users/{user}', [AdminController::class, 'viewUser'])->name('admin.user'); //Get the chosen users info and display
Route::patch('/admin/users/{user}/promote', [AdminController::class, 'promoteUser'])->name('admin.promote'); //Promote user to moderator or admin
Route::delete('/admin/users/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.delete'); //Delete user with password and admin authentication

});

// Only admin and moderator routes
Route::middleware(['admin', 'moderator'])->group(function (){

    //Admin and Moderator Routes
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/movies', [AdminController::class, 'store'])->name('admin.movie.store');

    //Get ALL Routes for Admin and Moderator
    Route::get('/admin/{type}', [AdminController::class, 'moderatorAll'])->name('admin.index');

    //Movie Routes
    Route::get('/admin/movies', [MovieController::class, 'index'])->name('admin.movies');
    Route::get('/admin/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/admin/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::patch('/admin/movies/{id}/update', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/admin/movies/{id}/delete', [MovieController::class, 'destroy'])->name('movies.delete');

    //Series Routes
    Route::get('/admin/series', [SerieController::class, 'index'])->name('series');
    Route::get('/admin/series/create', [SerieController::class, 'create'])->name('series.create');
    Route::post('/admin/series', [SerieController::class, 'store'])->name('series.store');
    Route::get('/admin/series/{id}/edit', [SerieController::class, 'edit'])->name('series.edit');
    Route::patch('/admin/series/{id}/update', [SerieController::class, 'update'])->name('series.update');
    Route::delete('/admin/series/{id}/delete', [SerieController::class, 'destroy'])->name('series.delete');

    //Actor Routes
    Route::get('/admin/actors', [ActorController::class, 'index'])->name('actors');
    Route::get('/admin/actors/create', [ActorController::class, 'create'])->name('actors.create');
    Route::post('/admin/actors', [ActorController::class, 'store'])->name('actors.store');
    Route::get('/admin/actors/{id}/edit', [ActorController::class, 'edit'])->name('actors.edit');
    Route::patch('/admin/actors/{id}/update', [ActorController::class, 'update'])->name('actors.update');
    Route::delete('/admin/actors/{id}/delete', [ActorController::class, 'destroy'])->name('actors.delete');

    //Director Routes
    Route::get('/admin/directors', [DirectorController::class, 'index'])->name('directors');
    Route::get('/admin/directors/create', [DirectorController::class, 'create'])->name('directors.create');
    Route::post('/admin/directors', [DirectorController::class, 'store'])->name('directors.store');
    Route::get('/admin/directors/{id}/edit', [DirectorController::class, 'edit'])->name('directors.edit');
    Route::patch('/admin/directors/{id}/update', [DirectorController::class, 'update'])->name('directors.update');
    Route::delete('/admin/directors/{id}/delete', [DirectorController::class, 'destroy'])->name('directors.delete');

    //Creator Routes
    Route::get('/admin/creators', [CreatorController::class, 'index'])->name('creators');
    Route::get('/admin/creators/create', [CreatorController::class, 'create'])->name('creators.create');
    Route::post('/admin/creators', [CreatorController::class, 'store'])->name('creators.store');
    Route::get('/admin/creators/{id}/edit', [CreatorController::class, 'edit'])->name('creators.edit');
    Route::patch('/admin/creators/{id}/update', [CreatorController::class, 'update'])->name('creators.update');
    Route::delete('/admin/creators/{id}/delete', [CreatorController::class, 'destroy'])->name('creators.delete');

    //Writer Routes
    Route::get('/admin/writers', [WriterController::class, 'index'])->name('writers');
    Route::get('/admin/writers/create', [WriterController::class, 'create'])->name('writers.create');
    Route::post('/admin/writers', [WriterController::class, 'store'])->name('writers.store');
    Route::get('/admin/writers/{id}/edit', [WriterController::class, 'edit'])->name('writers.edit');
    Route::patch('/admin/writers/{id}/update', [WriterController::class, 'update'])->name('writers.update');
    Route::delete('/admin/writers/{id}/delete', [WriterController::class, 'destroy'])->name('writers.delete');


    //Genre Routes
    Route::get('/admin/genres/create', [GenreController::class, 'create'])->name('genres.create');
    Route::post('/admin/genres', [GenreController::class, 'store'])->name('genres.store');
    Route::get('/admin/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
    Route::patch('/admin/genres/{id}/update', [GenreController::class, 'update'])->name('genres.update');
    Route::delete('/admin/genres/{id}/delete', [GenreController::class, 'destroy'])->name('genres.delete');

    //REGULAR USER ROUTES ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

     //CRUD Rating Routes
     Route::post('/display/ratings', [RatingController::class, 'store'])->name('ratings.store');
     Route::patch('/display/ratings/{id}/update', [RatingController::class, 'update'])->name('ratings.update');
     Route::delete('/display/ratings/{id}/delete', [RatingController::class, 'destroy'])->name('ratings.destroy');
 
     //CRUD Review Routes
     Route::post('/display/reviews', [ReviewController::class, 'store'])->name('reviews.store');
     Route::get('/display/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
     Route::get('/display/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
     Route::patch('/display/reviews/{id}/update', [ReviewController::class, 'update'])->name('reviews.update');
     Route::delete('/display/reviews/{id}/delete', [ReviewController::class, 'destroy'])->name('reviews.destroy');
 
     //Everything for user lists and watchlist
     //Watchlist
     Route::get('/watchlist/all/{id}', [WatchlistController::class, 'index'])->name('watchlist.index'); //To se everything in watchlist
     Route::get('/watchlist/{id}', [WatchlistController::class, 'dashboardWatchlist'])->name('watchlist.dashboardWatchlist'); //Watchlist for Dashboard
     Route::post('/watchlist/add/{id}', [WatchlistController::class, 'store'])->name('watchlist.store'); //Watchlist+ button
     Route::delete('/watchlist/delete/{id}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy'); //Watchlist- button
     //User Lists
     Route::get('/userlists/{id}', [UserListController::class, 'index'])->name('userlists.index'); //To get all the users lists with content for profile
     Route::get('/userlists/list/{id}', [UserListController::class, 'show'])->name('userlists.show'); //Views that list with all content
     Route::post('/userlists/create/{id}', [UserListController::class, 'store'])->name('userlists.store'); //Create new list button
     Route::patch('/userlists/update/{id}', [UserListController::class, 'update'])->name('userlists.update'); //Update list name
     Route::delete('/userlists/delete/{id}', [UserListController::class, 'destroy'])->name('userlists.destroy'); //Userlists- button
     //UserListContent
     Route::get('/userListContent/{id}', [UserListContentController::class, 'index'])->name('userListContent.index'); //All lists displayed for the user to add content to one or several lists
     Route::post('/userListContent/create/{id}', [UserListContentController::class, 'store'])->name('userListContent.store'); //Add button will be displayed if not in list
     Route::delete('/userListContent/delete/{id}', [UserListContentController::class, 'destroy'])->name('userListContent.destroy'); //Remove button will be displayed if it exists in the list
 
     //Profile
     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     //User profile
     Route::get('/user-profile', [UserProfileController::class, 'index'])->name('user.profile');
     
});

// Route::middleware()->group(function (){
// // Routes for CRUD for users own creations and moderators admins can play God!
// });

//ROUTES FOR ALL VIEWS AND STUFF YOU NEED TO BE LOGGED IN FOR.

Route::middleware(['auth'])->group(function () {

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
    //Watchlist 
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

//Filter Route
Route::get('/dashboard/movies', [DashboardController::class, 'filter'])->name('genres.movies');
Route::get('/dashboard/series', [DashboardController::class, 'filter'])->name('genres.series');


//Dashboard Routes for all to see. (Fetching Genres with movies and series)
Route::get('/dashboard/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/dashboard/movies', [DashboardController::class, 'index'])->name('genres.movies');
Route::get('/dashboard/series', [DashboardController::class, 'index'])->name('genres.series');

//View for seing everything in the specific genre
Route::get('/genres/{id}', [GenreController::class, 'show'])->name('genres.show');


// Kontaktformulär Routes
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index']);


//About us controller Route
Route::get('/about-us', [App\Http\Controllers\AboutUsController::class, 'index'])->name('about-us');


require __DIR__.'/auth.php';