<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\VenueController;

use App\Food;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/read', [DataBaseController::class, 'index']);
Route::get('/create/{name}', [DataBaseController::class, 'create']);
/*Route::get('/read', function(){
    $foods = Food::all();
    return $foods;


});*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile');

//Route for pages

//Event pages
Route::post('/events', [EventController::class, 'index'])->name('events');
Route::post('/createEvent', [EventController::class, 'create'])->name('createEvent');
Route::post('/event', [EventController::class, 'store'])->name('store.event');
Route::post('/event/details/{id}', [EventController::class, 'show'])->name('show.event');
Route::post('/event/details/edit/{id}', [EventController::class, 'edit'])->name('edit.event');
Route::post('/event/details/update/{id}', [EventController::class, 'update'])->name('update.event');

//Venue pages
Route::post('/venues', [VenueController::class, 'index'])->name('venues');
Route::post('/venue/create', [VenueController::class, 'create'])->name('create.venue');
Route::post('/venue', [VenueController::class, 'store'])->name('store.venue');
Route::post('/venue/details/{id}', [VenueController::class, 'show'])->name('show.venue');
Route::post('/venue/details/edit/{id}', [VenueController::class, 'edit'])->name('edit.venue');
Route::post('/venue/details/update/{id}', [VenueController::class, 'update'])->name('update.venue');
Route::post('/venue/details/delete/{id}', [VenueController::class, 'destroy'])->name('delete.venue');

