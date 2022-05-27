<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\VenueOrganizer;
use App\Models\EventVenueContract;
use Illuminate\Http\Request;
use function view;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        return view('dashboard.venue.venue_list',compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.venue.create');
        //return redirect()->route('dashboard.venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $venue = new Venue();
        $venue->VenueName = $request->venueName;
        $venue->MaxCapacity = $request->maxCapacity;
        $venue->venueOrganizerID = $id;

        $save = $venue->save();
        $venueOrganizer = VenueOrganizer::find($id);
        $venueOrganizer->venues()->attach($venue->VenueID);

        if( $save ){
            return redirect()->route('venue.home')->with('success','You created venue successfully.');
        }else{
            return redirect()->route('venue.home')->with('fail','Something went Wrong, failed to create');
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
        $venue =$this->getVenueDetails($id);
        return view('pages.venue.venue_details', compact('venue'));
    }

    /**
     *
     *
     *
     */
    public function showAllBookingRequest($id)
    {
        //get the venue organizer data
        $venueOrg = VenueOrganizer::find($id);

        //get all the venue id related data
        $venueIds = $venueOrg->getUserIdsAttribute();
        $venues = Venue::findMany($venueIds);

        //getEventVenueContractsAttribute
        return view('dashboard.venue.venue_book',compact('venues'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = $this->getVenueDetails($id);
        return view('dashboard.venue.venue_edit', compact('venue'));
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
        $venue = Venue::where('VenueID', '=', $id)->first();
        $venue->VenueName = $request->venueName;
        $venue->MaxCapacity = $request->maxCapacity;
        $save = $venue->save();

        if( $save ){
            return redirect()->route('venue.home')->with('success','You updated venue successfully.');
        }else{
            return redirect()->route('venue.home')->with('fail','Something went Wrong, failed to update');
        }
    }


    /**
     * approve the booking request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, $id)
    {
        $eventVenueContract = EventVenueContract::where('ContractID', '=', $id)->first();
        $eventVenueContract->ApprovalStatus = 'Approved';
        $save = $eventVenueContract->save();

        if( $save ){
            return redirect()->route('venue.home')->with('success','You updated venue successfully.');
        }else{
            return redirect()->route('venue.home')->with('fail','Something went Wrong, failed to update');
        }
    }


    /**
     * deny the booking request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deny(Request $request, $id)
    {
        $eventVenueContract = EventVenueContract::where('ContractID', '=', $id)->first();
        $eventVenueContract->ApprovalStatus = 'Denied';
        $save = $eventVenueContract->save();

        if( $save ){
            return redirect()->route('venue.home')->with('success','You updated venue successfully.');
        }else{
            return redirect()->route('venue.home')->with('fail','Something went Wrong, failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = getVenueDetails($id);
        $delete =$venue->delete();
        if( $delete ){
            return redirect()->route('venue.home')->with('success','You deleted venue successfully.');
        }else{
            return redirect()->route('venue.home')->with('fail','Something went Wrong, failed to delete');
        }
    }

    private function getVenueDetails($id){
        return Venue::find($id);
    }

}
