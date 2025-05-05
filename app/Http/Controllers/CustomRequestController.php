<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomRequestController extends Controller
{
    public function index(Request $req){
            $count=$req->item_count;
            return view('Orders.custom-request',compact('count'));
    }
}
