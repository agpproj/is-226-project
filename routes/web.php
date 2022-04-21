<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;

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
//Event page
Route::post('/events', [EventController::class, 'displayEventDetails'])->name('events');
Route::post('/createEvent', [EventController::class, 'create'])->name('createEvent');
Route::post('/event', [EventController::class, 'store'])->name('store.event');
