<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use Illuminate\Http\Request;

use App\Models\VenueOrganizer;
use Illuminate\Support\Facades\Auth;

class VenueOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        /*$venueOrg = VenueOrganizer::find(4);
        return view('dashboard.venue.venue_organizer_list',compact('venueOrg'));*/
        return view('dashboard.venue.venue_organizer_list',compact('venues'));
    }

    /**
     * Show all venue created by
     * Venue Organizer
     *
     */
    public function showAll($id){
        $venueOrg = VenueOrganizer::find($id);
        return view('dashboard.venue.venue_organizer_list',compact('venueOrg'));
    }

    function create(Request $request){
        //Validate inputs
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:venue_organizers,email',
            'companyName'=>'required',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $venueOrganizer = new VenueOrganizer();
        $venueOrganizer->name = $request->name;
        $venueOrganizer->email = $request->email;
        $venueOrganizer->companyName = $request->companyName;
        $venueOrganizer->password = \Hash::make($request->password);
        $save = $venueOrganizer->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully as Venue Organizer');
        }else{
            return redirect()->back()->with('fail','Something went Wrong, failed to register');
        }
    }

    function check(Request $request){
        //Validate Inputs
        $request->validate([
            'email'=>'required|email|exists:venue_organizers,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in venue_organizers table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('venue')->attempt($creds) ){
            return redirect()->route('venue.home');
        }else{
            return redirect()->route('venue.login')->with('fail','Incorrect Credentials');
        }
    }

    public function profile($id)
    {
        $venueOrg = VenueOrganizer::find($id);
        return view('dashboard.venue.profile',compact('venueOrg'));
    }

    function logout(){
        Auth::guard('venue')->logout();
        return redirect('/');
    }
}
