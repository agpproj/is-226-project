<?php

namespace App\Http\Controllers;

use App\Models\Users;

class ProfileController extends Controller
{
    public function showProfile($id)
    {
        $user = $this->getUserDetails($id);
        return view('profile.userProfile',compact('user'));
    }

    //retrive all users
    public function getUserDetails($id){
        $users = Users::find($id);
        return $users;
    }
}
