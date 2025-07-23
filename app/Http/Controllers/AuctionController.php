<?php

namespace App\Http\Controllers;

use App\DataTables\AuctionsDataTable;
use App\Events\AuctionEndEvent;
use App\Events\BidEvent;
use App\Mail\AuctionStart;
use App\Mail\WinnerPaymentMail;
use App\Models\Auction;
use App\Models\AuctionItem;
use App\Models\Registration;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class AuctionController extends Controller
{
    public function index(AuctionsDataTable $datatable)
    {
        $count = Auction::count();
        return $datatable->render('auction.index', compact('count'));
    }
    public function start($id)
    {

        $auction = Auction::find($id);
        if (!$auction) {
            toastr()->error("Auction Not Found!");
            return redirect()->back();
        }
        $currentTime = Carbon::now();
        $start_time = Carbon::parse($auction->start_date . ' ' . $auction->start_time)->addMinutes(5);
        if (!$currentTime->greaterThanOrEqualTo($start_time)) {
            toastr()->error("Cannot start auction right now!");
            return redirect()->back();
        }
        try {
            $auction->update([
                'status' => 'ongoing'
            ]);
            $registeredUsers = $auction->registeredUsers;
            foreach ($registeredUsers as $user) {
                Mail::to($user->email)->send(new AuctionStart($auction, $user));
            }
            toastr()->success("Auction Started!");
        } catch (\Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function end($id)
    {
        try {
            $auction = Auction::find($id);
            $items = $auction->items;
            $currentTime = Carbon::now();
            $start_time = Carbon::parse($auction->start_date . ' ' . $auction->start_time);
            if (!$currentTime->greaterThan($start_time)) {
                toastr()->error("Cannot end auction right now!");
                return redirect()->back();
            }
            foreach ($items as $item) {
                Mail::to($item->winner->email)->send(new WinnerPaymentMail($item, $auction));
            }
            $auction->update([
                "status" => "ended"
            ]);
            broadcast(new AuctionEndEvent($auction->id));
            toastr()->success("Auction Ended Successfully");
        } catch (\Exception $error) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->route('auction');
    }

    public function placeBid(Request $req, $id)
    {
        $item = AuctionItem::find($id);
        $auction = $item->auction->id;
        $minBid = $item->current_bid ? $item->current_bid + 1000 : $item->starting_bid + 1;
        $req->validate([
            'bid_amount' => 'required|numeric|min:' . $minBid,
        ]);
        $item->update([
            "current_bid" => $req->bid_amount,
            "winner_id" => $req->user_id,
        ]);
        broadcast(new BidEvent($auction, $item->current_bid, $item->id));
       return response()->json([
        "message" => "Bid Placed Successfully!",
        "amount" => $item->current_bid,
        "item_id" => $item->id,
    ]);
    }
    public function form(Request $req)
    {
        if (!auth()->user()->profile->cnic) {
            toastr()->error("Please Complete your Profile!");
            return redirect()->back();
        }
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
            'items.*.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);
        if(!auth()->user()->profile->address){
            toastr()->error("Complete Your Profile!");
            return redirect()->back();
        }
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
        return redirect()->route('auction');
    }

    public function items($id)
    {
        if (!AuctionItem::where('auction_id', $id)->exists()) {
            toastr()->error("No Items Exist!");
            return redirect()->back();
        }

        $items = AuctionItem::where('auction_id', $id)->get();

        return view('auction.items', compact('items', 'id'));
    }

    public function participate($id){
            $auction=Auction::find($id);
            if($auction->status==="ended"){
                toastr()->info("This Auction Has Been Ended!");
                return redirect()->back();
            }else{
                $this->items($id);
            }
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
                toastr()->error("Auction does not exist!");
                return redirect()->back();
            }
            if ($auction->status !== "upcoming") {
                toastr()->error("Cannot delete this auction now!");
                return redirect()->back();
            }
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
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
        if (!Auction::where('id', $req->auction_id)->exists()) {
            toastr()->error("Auction does not exist!");
            return redirect()->back();
        }

        if (!auth()->user()->profile->cnic) {
            toastr()->error("Complete Your Profile!");
            return redirect()->back();
        }

        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
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
        $auction = Auction::find($id);
        if (!$auction) {
            toastr()->error("Auction does not exist!");
            return redirect()->back();
        }

        if ($auction->status !== "upcoming") {
            toastr()->error("Cannot claim refund now!");
        }

        try {
            $reg = Registration::where('auction_id', $id)->where('user_id', auth()->id())->first();
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
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
