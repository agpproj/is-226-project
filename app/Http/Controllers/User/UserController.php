<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function create(Request $request){
        //Validate Inputs
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();

        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong, failed to register');
        }
    }

    function check(Request $request){
        //Validate inputs
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists on users table'
        ]);

        $creds = $request->only('email','password');
        if( Auth::guard('web')->attempt($creds) ){
            return redirect()->route('user.home');
            //$events = Event::all();
            //return view('dashboard.user.home', compact('events'));
        }else{
            return redirect()->route('user.login')->with('fail','Incorrect credentials');
        }
    }

    function join($eventId, $userId){
        $dt = Carbon::now();
        $ticket = Event::find($eventId)->ticket;
        $purchase = new Purchase();
        $purchase->statusID = 'Registered';
        $purchase->datePurchased = $dt->toDateString();
        $purchase->timePurchased = $dt->toTimeString();
        $purchase->TicketID = $ticket->TicketID;

        $user = User::find($userId);
        $save = $user->purchase()->save($purchase);

        if( $save ){
            return redirect()->route('user.home')->with('success','You updated purchase successfully.');
        }else{
            return redirect()->route('user.home')->with('fail','Something went Wrong, failed to update purchase.');
        }
    }

    function myTicket($id){
        $user = User::find($id);
        $ticketID = $user->purchase->where('statusID', 'Registered')->pluck('TicketID');

        //get ticket details related to purchased ID
        $eventIds = Ticket::findMany($ticketID)->pluck('EventID');;
        $events = Event::findMany($eventIds);
        return view('dashboard.user.my_ticket',compact('events'));
    }

    function cancel($id) {
        $ticket = Event::find($id)->ticket;
        $user = Auth::user();
        $purchase = $user->purchase->where('TicketID', $ticket->TicketID)->first();

        $purchase->statusID = 'Cancelled';
        $save = $purchase->save();
        if( $save ){
            return redirect()->route('user.home')->with('success','You updated purchase successfully.');
        }else{
            return redirect()->route('user.home')->with('fail','Something went Wrong, failed to update purchase.');
        }
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('dashboard.user.profile',compact('user'));
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
