<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index (){
        return view('auction.index');
    }
    public function test(){
        return view('auction.test');
    }
}
