<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function store(Request $req){
        $req->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'starting_bid'=>'required|min:1',
            'image'=>'required|mimes:jpeg,png,jpg'
        ]);
        try{
        if($req->hasFile('image')){
            $image = $req['image']->store('auction_items', 'public');
            $imagePath = asset('storage/' . $image);
            AuctionItem::create([
                    'auction_id' => $req->auction_id,
                    'name' => $req['name'],
                    'description' => $req['description'],
                    'starting_bid' => $req['starting_bid'],
                    'current_bid' => null,
                    'winner_id' => null,
                    'image' => $imagePath,
                ]);
            toastr()->success("Item Added Successfully!");
        }
        }catch(\Exception $error){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
        dd($req->toArray());
    }

    public function delete($id){
        try{
            $items=AuctionItem::find($id)->delete();
            toastr()->success("Item Deleted Successfully!");
        }catch(\Exception $error){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
