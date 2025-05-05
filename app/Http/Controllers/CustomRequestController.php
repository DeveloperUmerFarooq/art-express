<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomRequestController extends Controller
{
    public function index(Request $req){
            $req->validate([
                'user_email'=>'required|email|exists:users,email',
                'item_count'=>'required|min:1'
            ]);
            $count=$req->item_count;
            if($req->user_email==auth()->user()->email){
                toastr()->error("Seller cannot be customer");
                return redirect()->back();
            }
            $id = User::where('email', $req->user_email)->pluck('id')->first();
            return view('Orders.custom-request',compact('count','id'));
    }
}
