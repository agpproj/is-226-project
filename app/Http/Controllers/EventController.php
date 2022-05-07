<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventVenueContract;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('pages.event.createEvent', compact('id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $event = new Event;

        $event->EventName = $request->eventName;
        $event->EventDescription = $request->eventDescription;
        $event->EventStartDate = $request->eventStartDate;
        $event->EventEndDate = $request->eventEndDate;
        $event->EventStartTime = $request->eventStartTime;
        $event->EventEndTime = $request->eventEndTime;
        $event->AllowedCapacity = $request->allowedCapacity;

        $event->save();

        $event = Event::find($event->EventID);
        $eventVenueContract = new EventVenueContract;
        $eventVenueContract->BookStartDate = $request->bookStartDate;
        $eventVenueContract->BookEndDate = $request->bookEndDate;
        $eventVenueContract->BookStartTime = $request->bookStartTime;
        $eventVenueContract->BookEndTime = $request->bookEndTime;
        $eventVenueContract->EventID  = $event->EventID;
        $eventVenueContract->VenueID  = $id;
        $eventVenueContract->ApprovalStatus = 'Pending';
        $event->eventVenueContract()->save($eventVenueContract);
        return view('pages.event.createEvent', compact('id'));
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


