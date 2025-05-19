<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index (){
        return view('auction.index');
    }
    public function test(){
        $count=Auction::count();
        return view('auction.test',compact('count'));
    }
    public function form(Request $req){
        return view('auction.create')->with(['itemCount'=>$req->item_count]);
    }
    public function store(Request $req){
        dd($req->toArray());
    }
}
