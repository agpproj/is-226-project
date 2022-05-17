<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventOrganizer;
use App\Models\EventVenueContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventOrganizerController extends Controller
{

    function create(Request $request){
        //Validate inputs
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:event_organizers,email',
            'companyName'=>'required',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $eventOrganizer = new EventOrganizer();
        $eventOrganizer->name = $request->name;
        $eventOrganizer->email = $request->email;
        $eventOrganizer->companyName = $request->companyName;
        $eventOrganizer->password = \Hash::make($request->password);
        $save = $eventOrganizer->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully as Event Organizer');
        }else{
            return redirect()->back()->with('fail','Something went Wrong, failed to register');
        }
    }

    function showEventContract($id){

        $events = EventVenueContract::where('eventOrganizerID', '=', $id)->get();
        return view('dashboard.event.event_contract', compact('events'));
    }

    function check(Request $request){
        //Validate Inputs
        $request->validate([
            'email'=>'required|email|exists:event_organizers,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in event_organizers table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('event')->attempt($creds) ){
            return redirect()->route('event.home');
        }else{
            return redirect()->route('event.login')->with('fail','Incorrect Credentials');
        }
    }

    function logout(){
        Auth::guard('event')->logout();
        return redirect('/');
    }
}
