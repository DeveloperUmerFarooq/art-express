<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\AuctionItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected $delivery;
    public function show($item){
        $AuctionItem=AuctionItem::find($item);
        return view('auction.checkout')->with(['item'=>$AuctionItem]);
    }
    public function checkout(Request $req){
        $req->validate([
            'stripeToken'=>'required',
            'item_id'=>'required'
        ]);
        $item=AuctionItem::find($req->item_id);
        $host=User::find($item->auction->host_id);
        $winner=User::find($item->winner->id);
        $profit = $item->current_bid - $item->starting_bid;
        $share = round($profit * 0.5);
        $price=$item->current_bid-$share;

        $userCity = $winner->profile->city;
        $artistCity= $host->profile->city;
        $to=getCoordinates($userCity);
        $from=getCoordinates($artistCity);
        $distance=getDistanceInKm($from,$to);
        $this->delivery=deliverCharge($distance);

        DB::beginTransaction();
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $charge = $stripe->charges->create([
                'amount' => ($item->current_bid + $this->delivery) * 100,
                'currency' => 'pkr',
                'source' => $req->stripeToken,
                'description' => "payment for auction item"
            ]);
            $order = Order::create([
                'payment_id' => $charge->id,
                'type' => 'custom',
                'customer_id' => $winner->id,
                'artist_id' => $host->id,
                'user_address' => $winner->profile->address,
                'customer_email'=>$winner->email,
                'artist_address' => $host->profile->address,
                'user_contact' => $winner->profile->phone_number,
                'order_date' => now(),
                'payment_status' =>'Payed' ,
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'item_name' => $item->name,
                'img_src' => $item->image,
                'price' => $price,
                'quantity' => 1,
                'total_price' => $item->current_bid+$this->delivery,
            ]);
            $item->status="Sold";
            $item->save();
            DB::commit();
            $artist = User::find($req->artist_id);
            $admin = User::role('admin')->first();

            Mail::to($req->customer_email)->send(new OrderMail($order,$order->customer->name));
            Mail::to($artist->email)->send(new OrderMail($order,$artist->name));
            Mail::to($admin->email)->send(new OrderMail($order,$admin->name));
            toastr()->success("Order Has Been Placed!");
        }catch(\Exception $error){
            DB::rollBack();
            toastr()->error("Operation Failed!");
            return redirect()->back();
        }
        return redirect()->route('welcome');
    }
}
