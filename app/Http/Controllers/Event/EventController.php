<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventOrganizer;
use App\Models\Purchase;
use App\Models\Venue;
use App\Models\Ticket;
use App\Models\EventVenueContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function view;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        return view('dashboard.event.venue_list',compact('venues'));
    }

    /**
     * Show the form for booking a venue.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBook($id)
    {
        return view('dashboard.event.event_book', compact('id'));
    }

    /**
     * Show the form for creating a new event.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEvent()
    {
        return view('dashboard.event.event_create');
    }

    /**
     * Store event
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $event = new Event();
        $event->EventName = $request->eventName;
        $event->EventDescription = $request->eventDescription;
        $event->EventStartDate = $request->eventStartDate;
        $event->EventEndDate = $request->eventEndDate;
        $event->EventStartTime = $request->eventStartTime;
        $event->EventEndTime = $request->eventEndTime;
        $event->EventStatus = 'Open';
        $event->AllowedCapacity = $request->allowedCapacity;

        $save = $event->save();

        if (!$save) {
            return redirect()->route('event.home')->with('fail','Something went Wrong, failed to create.');
        }
        $eventOrg = EventOrganizer::find($id);
        $eventOrg->events()->attach($event->EventID);

        $ticket = new Ticket();
        //$ticket->EventID = $event->EventID;
        $ticket->PriceValue = $request->price;

        $save = $event->ticket()->save($ticket);

        if( $save ){
            return redirect()->route('event.contract', Auth::user()->eventOrganizerID)->with('success','You created event successfully.');
        }else{
            return redirect()->route('event.contract', Auth::user()->eventOrganizerID)->with('fail','Something went Wrong, failed to create.');
        }
    }

    /**
     * Store event venue contract
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContract(Request $request, $venueId, $eventOrgId)
    {
        $eventVenueContract = new EventVenueContract;
        $eventVenueContract->EventName = $request->eventName;
        $eventVenueContract->BookStartDate = $request->bookStartDate;
        $eventVenueContract->BookEndDate = $request->bookEndDate;
        $eventVenueContract->BookStartTime = $request->bookStartTime;
        $eventVenueContract->BookEndTime = $request->bookEndTime;
        $eventVenueContract->eventOrganizerID  = $eventOrgId;
        $eventVenueContract->ApprovalStatus = 'Pending';
        $eventVenueContract->save();
        $contractId = $eventVenueContract->ContractID;

        $venue = Venue::find($venueId);
        $save = $venue->eventVenueContracts()->attach($contractId);

        if( $save ){
            return redirect()->route('event.list')->with('success','You booked event successfully.');
        }else{
            return redirect()->route('event.list')->with('fail','Something went Wrong, failed to book event.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event =$this->getEventDetails($id);
        return view('pages.event.event_details', compact('event'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMyEvents($id)
    {
        $eventOrg = EventOrganizer::find($id);
        return view('dashboard.event.event_list', compact('eventOrg'));
    }
    /**
     * Display all the events
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllEvents()
    {
        $events = Event::all();
//        return view('dashboard.user.home', compact('events'));
        return view('dashboard.user.event_list', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->getEventDetails($id);
        return view('dashboard.event.event_edit', compact('event'));
    }


    /**
     * Cancel the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, $id)
    {
        $event = Event::where('EventID', '=', $id)->first();
        $event->EventStatus = 'Cancelled';
        $save = $event->save();

        if( $save ){
            return redirect()->route('event.my.events', Auth::user()->eventOrganizerID)->with('fail','Something went Wrong, failed to update event.');
        }else{
            return redirect()->route('event.my.events', Auth::user()->eventOrganizerID)->with('fail','Something went Wrong, failed to update event.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::where('EventID', '=', $id)->first();
        $event->EventName = $request->eventName;
        $event->EventDescription = $request->eventDescription;
        $event->EventStartDate = $request->eventStartDate;
        $event->EventEndDate = $request->eventEndDate;
        $event->EventStartTime = $request->eventStartTime;
        $event->EventEndTime = $request->eventEndTime;
        $event->AllowedCapacity = $request->allowedCapacity;
        $save = $event->save();

        if( !$save ){
            return redirect()->route('event.my.events', Auth::user()->eventOrganizerID)->with('fail','Something went Wrong, failed to update event.');
        }

        $ticket = Ticket::where('EventID', '=', $event->EventID)->first();
        $ticket->PriceValue = $request->price;

        $save = $ticket->save();

        if( $save ){
            return redirect()->route('event.my.events', Auth::user()->eventOrganizerID)->with('success','You updated event successfully');
        }else{
            return redirect()->route('event.my.events', Auth::user()->eventOrganizerID)->with('fail','Something went Wrong, failed to update event.');
        }
    }

    public function registeredList($id){
        $ticketIDs = Ticket::where('EventID', $id)->pluck('TicketID');
        $purchases = Purchase::whereIn('TicketID', $ticketIDs)->get();
        $count = $purchases->where('purchaseID')->count();

        $registeredPercentage = $count != 0 ? ($purchases->count() / $count) * 100 : 0;
        $scannedPercentage = $count != 0 ? ($purchases->where('statusID', 'Scanned')->count() / $count) * 100 : 0;
        $invalidCount = $purchases->where('statusID', 'Invalid')->count();
        $expiredCount = $purchases->where('statusID', 'Expired')->count();

        return view('dashboard.event.event_purchased_ticket', compact('purchases', 'count',
            'registeredPercentage', 'scannedPercentage', 'invalidCount', 'expiredCount'));
    }

    public function attendanceCheck($id){
        $purchase = Purchase::find($id);
        $purchase->statusID = 'Scanned';
        $save = $purchase->save();

        $ticket = Ticket::find($purchase->TicketID);
        if( $save ){
            return redirect()->route('event.registered', $ticket->EventID)->with('success','You updated event successfully.');
        }else{
            return redirect()->route('event.registered', $ticket->EventID)->with('fail','Something went Wrong, failed to update event.');
        }
    }

    //retrive event details of the EventID
    public function getEventDetails($id){
        return Event::find($id);
    }

    //retrive all events
    public function getAllEvents(){
        $event = Event::all();
        return $event;
    }
}


