<?php

namespace App\Http\Controllers;

use App\DataTables\AuctionsDataTable;
use App\Models\Auction;
use App\Models\AuctionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    public function index()
    {
        return view('auction.index');
    }
    public function test(AuctionsDataTable $datatable)
    {
        $count = Auction::count();
        return $datatable->render('auction.test', compact('count'));
    }
    public function form(Request $req)
    {
        return view('auction.create')->with(['itemCount' => $req->item_count]);
    }
    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_date' => 'required|date|after:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.description' => 'nullable|string|max:1000',
            'items.*.starting_bid' => 'required|numeric|min:1',
            'items.*.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $auction = Auction::create([
            'host_id' => Auth::id(),
            'title' => $req->title,
            'description' => $req->description,
            'start_date' => $req->start_date,
            'start_time' => $req->start_time,
            'end_time' => $req->end_time,
        ]);
        foreach ($req->items as $item) {
        $image = $item['image']->store('auction_items', 'public');
        $imagePath=asset('storage/'.$image);

        AuctionItem::create([
            'auction_id' => $auction->id,
            'name' => $item['name'],
            'description' => $item['description'],
            'starting_bid' => $item['starting_bid'],
            'current_bid' => null,
            'winner_id' => null,
            'image' => $imagePath,
        ]);
    }
        $role=auth()->user()->getRoleNames()->first();
        return redirect()->route($role.'.auctions');
    }

    public function items($id){
        $items=AuctionItem::where('auction_id',$id)->get();
        return view('auction.items',compact('items'));
    }
}
