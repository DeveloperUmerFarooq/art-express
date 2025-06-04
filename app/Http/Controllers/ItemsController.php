<?php

namespace App\Http\Controllers;

use App\Models\AuctionItem;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'starting_bid' => 'required|min:1',
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);
        try {
            if ($req->hasFile('image')) {
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
        } catch (\Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
        dd($req->toArray());
    }

    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'starting_bid' => 'required|min:1',
            'image' => 'mimes:jpeg,png,jpg|nullable'
        ]);
        try {
            $item = AuctionItem::find($req->item_id);
            if($item->auction->status!=="upcoming"){
                toastr()->error("Cannot Update Item Now!");
                return redirect()->back();
            }
            $imagePath=$item->image;
            if($req->hasFile('image')){
                $image = $req['image']->store('auction_items', 'public');
                $imagePath = asset('storage/' . $image);
            }
            $item->update([
                'name' => $req['name']??$item->name,
                'description' => $req['description']??$item->desciption,
                'starting_bid' => $req['starting_bid']??$item->starting_bid,
                'image' => $imagePath,
            ]);
            toastr()->success("Item Updated Successfully!");
        } catch (\Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $item = AuctionItem::find($id);
             if($item->auction->status!=="upcoming"){
                toastr()->error("Cannot Update Item Now!");
                return redirect()->back();
            }
            $item->delete();
            toastr()->success("Item Deleted Successfully!");
        } catch (\Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
