<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function displayEventDetails()
    {
        $events = $this->getAllEvents();
        return view('pages.event',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.createEvent');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        return view('pages.createEvent');
    }

    public function updateEventDetails()
    {

    }

    //retrive event details of the EventID
    public function getEventDetails($id){
        $event = Event::firstWhere('EventID',1);
        return $event;
    }

    //retrive all events
    public function getAllEvents(){
        $event = Event::all();
        return $event;
    }
}


