<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;



class FollowsController extends Controller
{
    //フォローしている人
    public function followList(){
        return view('follows.followList');
    }
    //フォローされている人
    public function followerList(){
        return view('follows.followerList');
    }
}
