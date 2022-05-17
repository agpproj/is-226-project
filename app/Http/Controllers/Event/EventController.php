<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventOrganizer;
use App\Models\Venue;
use App\Models\EventVenueContract;
use Illuminate\Http\Request;
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
        $events = $this->getAllEvents();
        return view('pages.event.event_all',compact('events'));
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
        $event->PriceValue = $request->price;
        $event->AllowedCapacity = $request->allowedCapacity;

        $save = $event->save();

        $eventOrg = EventOrganizer::find($id);
        $eventOrg->event()->attach($event->EventID);

        if( $save ){
            return redirect()->route('event.home')->with('success','You created event successfully.');
        }else{
            return redirect()->route('event.home')->with('fail','Something went Wrong, failed to create.');
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
        $eventVenueContract->BookStartDate = $request->bookStartDate;
        $eventVenueContract->BookEndDate = $request->bookEndDate;
        $eventVenueContract->BookStartTime = $request->bookStartTime;
        $eventVenueContract->BookEndTime = $request->bookEndTime;
        $eventVenueContract->eventOrganizerID  = $eventOrgId;
        $eventVenueContract->ApprovalStatus = 'Pending';
        $save = $eventVenueContract->save();
        $contractId = $eventVenueContract->ContractID;

        $venue = Venue::find($venueId);
        $venue->eventVenueContracts()->attach($contractId);

        if( $save ){
            return redirect()->route('event.home')->with('success','You booked event successfully.');
        }else{
            return redirect()->route('event.home')->with('fail','Something went Wrong, failed to book event.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->getEventDetails($id);
        return view('pages.event.edit_event', compact('event'));
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
        $event->save();

        return view('home');
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


