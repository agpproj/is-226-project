<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
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

    function join(){
        $dt = Carbon::now();
        $purchase = new Purchase();
        $purchase->statusID = 'Registered';
        $purchase->datePurchased = $dt->toDateString();
        $purchase->timePurchased = $dt->toTimeString();

        $save = $purchase->save();

        if( $save ){
            return redirect()->route('user.home')->with('success','You updated purchase successfully.');
        }else{
            return redirect()->route('user.home')->with('fail','Something went Wrong, failed to update purchase.');
        }
    }

    function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
