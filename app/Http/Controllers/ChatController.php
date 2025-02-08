<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function inbox(){
        return view('messages.inbox');
    }

    public function index($id){
        $user=User::role('artist')->with('profile')->find($id);
        return view('messages.chat')->with('reciever',$user);
    }
}
