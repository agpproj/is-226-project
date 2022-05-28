<?php

use App\Models\Event;
use App\Models\EventOrganizer;
use App\Models\EventVenueContract;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Venue;
use App\Models\VenueOrganizer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Venue\VenueOrganizerController;
use App\Http\Controllers\Venue\VenueController;
use App\Http\Controllers\Event\EventOrganizerController;
use App\Http\Controllers\Event\EventController;

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

Auth::routes();

Route::view('/user/participant','dashboard.user.login')->name('userParticipant');
Route::view('/event/organizer','dashboard.event.login')->name('eventOrganizer');
Route::view('/venue/organizer','dashboard.venue.login')->name('venueOrganizer');

Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');
    });

    Route::middleware(['auth'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');
        Route::get('/events',function(){
            $events = Event::all();
            return view('dashboard.user.event_list', compact('events'));
        })->name('events');
        Route::get('/ticket/{id}',function($id){
            $user = User::find($id);
            $registeredEvents = [];
            $scannedEvents = [];
            if ($user->purchase != null) {
                $ticketID = $user->purchase->where('statusID', 'Registered')->pluck('TicketID');

                //get ticket details related to purchased ID
                $eventIds = Ticket::findMany($ticketID)->pluck('EventID');;
                $registeredEvents = Event::findMany($eventIds);

                //scanned ticket
                $scannedTicketID = $user->purchase->where('statusID', 'Scanned')->pluck('TicketID');

                //get ticket details related to purchased ID
                $scannedEventIds = Ticket::findMany($scannedTicketID)->pluck('EventID');;
                $scannedEvents = Event::findMany($scannedEventIds);
            }
            return view('dashboard.user.my_ticket',compact('registeredEvents', 'scannedEvents'));

        })->name('ticket');
        Route::post('/profile/{id}', [UserController::class, 'profile'])->name('profile');
        Route::post('/events',[EventController::class,'showAllEvents'])->name('events');
        Route::post('/cancel/{id}',[UserController::class,'cancel'])->name('cancel');
        Route::post('/join/{eventId}/{userId}',[UserController::class,'join'])->name('join');
        Route::post('/ticket/{id}',[UserController::class,'myTicket'])->name('ticket');
        Route::post('/feedback/{id}', [UserController::class, 'feedback'])->name('feedback');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');
    });

});

Route::prefix('venue')->name('venue.')->group(function(){

    Route::middleware(['guest:venue'])->group(function(){
        Route::view('/login','dashboard.venue.login')->name('login');
        Route::view('/register','dashboard.venue.register')->name('register');
        Route::post('/user/create',[VenueOrganizerController::class,'create'])->name('user.create');
        Route::post('/user/check',[VenueOrganizerController::class,'check'])->name('user.check');
        Route::post('/store', [VenueController::class, 'store'])->name('store');
    });

    Route::middleware(['auth:venue'])->group(function(){
        Route::view('/home','dashboard.venue.home')->name('home');
        Route::view('/create', 'dashboard.venue.create')->name('create');
        Route::get('/name/list/{id}',function($id) {
            $venueOrg = VenueOrganizer::find($id);
            return view('dashboard.venue.venue_organizer_list',compact('venueOrg'));
        })->name('name.list');

        Route::get('/book/request/{id}', function($id){
            //get the venue organizer data
            $venueOrg = VenueOrganizer::find($id);

            //get all the venue id related data
            $venueIds = $venueOrg->getUserIdsAttribute();
            $venues = Venue::findMany($venueIds);

            //getEventVenueContractsAttribute
            return view('dashboard.venue.venue_book',compact('venues'));
        })->name('book.request');


        Route::post('/profile/{id}', [VenueOrganizerController::class, 'profile'])->name('profile');
        Route::post('/create', [VenueController::class,'create'])->name('create');
        Route::post('/list', [VenueController::class,'index'])->name('list');
        Route::post('/name/list/{id}', [VenueOrganizerController::class,'showAll'])->name('name.list');
        Route::post('/book/request/{id}', [VenueController::class,'showAllBookingRequest'])->name('book.request');
        Route::post('/edit/{id}', [VenueController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [VenueController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [VenueController::class, 'destroy'])->name('delete');
        Route::post('/show/{id}', [VenueController::class,'create'])->name('show');
        Route::post('/store/{id}', [VenueController::class, 'store'])->name('store');
        Route::post('/events/{id}', [VenueController::class, 'events'])->name('events');
        Route::post('/approve/{id}', [VenueController::class, 'approve'])->name('approve');
        Route::post('/deny/{id}', [VenueController::class, 'deny'])->name('deny');
        Route::post('/logout',[VenueOrganizerController::class,'logout'])->name('logout');
    });

});


Route::prefix('event')->name('event.')->group(function(){

    Route::middleware(['guest:event'])->group(function(){
        Route::view('/login','dashboard.event.login')->name('login');
        Route::view('/register','dashboard.event.register')->name('register');
        Route::post('/user/create',[EventOrganizerController::class,'create'])->name('user.create');
        Route::post('/user/check',[EventOrganizerController::class,'check'])->name('user.check');
    });

    Route::middleware(['auth:event'])->group(function(){
        Route::view('/home','dashboard.event.home')->name('home');
        Route::get('/events/{id}', function($id){
            $eventOrg = EventOrganizer::find($id);
            return view('dashboard.event.event_list', compact('eventOrg'));
        })->name('my.events');
        Route::get('/list', function(){
            $venues = Venue::all();
            return view('dashboard.event.venue_list',compact('venues'));
        })->name('list');
        Route::get('/contract/{id}', function($id){
            $events = EventVenueContract::where('eventOrganizerID', '=', $id)->get();
            return view('dashboard.event.event_contract', compact('events'));
        })->name('contract');
        Route::post('/profile/{id}', [EventOrganizerController::class, 'profile'])->name('profile');
        Route::post('/create', [EventController::class, 'createEvent'])->name('create');
        Route::post('/create/book/{id}', [EventController::class, 'createBook'])->name('book');
        Route::post('/events/{id}', [EventController::class, 'showMyEvents'])->name('my.events');
        Route::post('/store/{id}', [EventController::class, 'store'])->name('store');
        Route::post('/edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::post('/cancel/{id}', [EventController::class, 'cancel'])->name('cancel');
        Route::post('/registered/{id}', [EventController::class, 'registeredList'])->name('registered');
        Route::post('/attendance/{id}', [EventController::class, 'attendanceCheck'])->name('attendance');
        Route::post('/store/{venueId}/{eventOrgId}', [EventController::class, 'storeContract'])->name('store.contract');
        Route::post('/contract/{id}', [EventOrganizerController::class,'showEventContract'])->name('contract');
        Route::post('/list', [EventController::class,'index'])->name('list');
        Route::post('/logout',[EventOrganizerController::class,'logout'])->name('logout');
    });
});

Route::post('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile');






//Route for pages

//Event pages
/*Route::post('/events', [EventOrganizerController::class, 'index'])->name('events');
Route::post('/create/event/{id}', [EventOrganizerController::class, 'create'])->name('book.event');
Route::post('/event/{id}', [EventOrganizerController::class, 'store'])->name('store.event');
Route::post('/event/details/{id}', [EventOrganizerController::class, 'show'])->name('show.event');
Route::post('/event/details/edit/{id}', [EventOrganizerController::class, 'edit'])->name('edit.event');
Route::post('/event/details/update/{id}', [EventOrganizerController::class, 'update'])->name('update.event');*/

//Venue pages
/*Route::post('/venues', [VenueOrganizerController::class, 'index'])->name('venues');
Route::post('/venues/all', [VenueOrganizerController::class, 'index'])->name('venues.all');
Route::post('/venue/create', [VenueOrganizerController::class, 'create'])->name('create.venue');
Route::post('/venue', [VenueOrganizerController::class, 'store'])->name('store.venue');
Route::post('/venue/details/{id}', [VenueOrganizerController::class, 'show'])->name('show.venue');
Route::post('/venue/details/edit/{id}', [VenueOrganizerController::class, 'edit'])->name('edit.venue');
Route::post('/venue/details/update/{id}', [VenueOrganizerController::class, 'update'])->name('update.venue');
Route::post('/venue/details/delete/{id}', [VenueOrganizerController::class, 'destroy'])->name('delete.venue');*/

