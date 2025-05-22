<?php

namespace App\Http\Controllers;

use App\DataTables\AuctionsDataTable;
use App\Models\Auction;
use App\Models\AuctionItem;
use App\Models\Registration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

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
        try {
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
                $imagePath = asset('storage/' . $image);

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
            toastr()->success("Auction created successfully!");
        } catch (Exception $error) {
            toastr()->error("Operation Failed!");
        }
        $role = auth()->user()->getRoleNames()->first();
        return redirect()->route($role . '.auctions');
    }

    public function items($id)
    {
        if (!AuctionItem::where('auction_id', $id)->exists()) {
            toastr()->error("No Items Exist!");
            return redirect()->back();
        }

        $items = AuctionItem::where('auction_id', $id)->get();

        return view('auction.items', compact('items'));
    }

    public function update(Request $req)
    {
        try {
            $auction = Auction::find($req->auction_id);
            $auction->update([
                'title' => $req->title ?? $auction->title,
                'description' => $req->description ?? $auction->description,
            ]);
            toastr()->success("Auction Updated Successfully!");
        } catch (Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $auction = Auction::find($id);
            if (!$auction) {
                toastr("Auction does not exist!");
                return redirect()->back();
            }
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $regs = Registration::where('auction_id', $auction->id)->get();

            if ($regs->count()) {
                foreach ($regs as $reg) {
                    $refund = $stripe->refunds->create([
                        'charge' => $reg->payment_id,
                    ]);
                    if ($refund->status === 'succeeded') {
                        $reg->delete();
                    }
                }
            }
            $auction->delete();
            DB::commit();
            toastr()->success("Auction Deleted Successfully!");
        } catch (Exception $error) {
            toastr()->error("Operation Failed!");
            DB::rollBack();
        }
        return redirect()->back();
    }

    public function register(Request $req)
    {
        // dd($req->toArray());
        if (!Auction::where('id', $req->auction_id)->exists()) {
            toastr()->error("Auction does not exist!");
            return redirect()->back();
        }

        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $charge = $stripe->charges->create([
                'amount' => 2000 * 100,
                'currency' => 'pkr',
                'source' => $req->stripe_token,
                'description' => "Registeration for Auction"
            ]);
            if ($charge->status === 'succeeded') {
                Registration::create([
                    'user_id' => $req->user_id,
                    'auction_id' => $req->auction_id,
                    'payment_id' => $charge->id,
                ]);
                toastr()->success("Registration Successfull!");
            } else {
                toastr()->error("Payment Process Failed!");
            }
        } catch (Exception $error) {
            toastr()->error("Operation Failed! Try Again!");
        }
        return redirect()->back();
    }

    public function refund($id)
    {
        if (!Auction::where('id', $id)->exists()) {
            toastr()->error("Auction does not exist!");
            return redirect()->back();
        }
        try {
            $reg = Registration::where('auction_id', $id)->where('user_id', auth()->id())->first();
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $refund = $stripe->refunds->create([
                'charge' => $reg->payment_id,
                'amount' => 1900 * 100,
            ]);
            if ($refund->status === 'succeeded') {
                $reg->delete();
                toastr()->success("Refund Successfull!");
            } else {
                toastr()->error("Refund Failed!");
            }
        } catch (Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
