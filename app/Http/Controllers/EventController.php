<?php

namespace App\Http\Controllers;

use App\Models\Event;
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
    public function create()
    {
        return view('pages.event.createEvent');
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
        return view('pages.event.createEvent');
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


