<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailValidator;

class CustomRequestController extends Controller
{
    protected $emailValidator;
    public function __construct(EmailValidator $validate)
    {
        $this->emailValidator=$validate;
    }
    public function index(Request $req){
            $req->validate([
                'user_email'=>'required|email|exists:users,email',
                'item_count'=>'required|min:1'
            ]);
            if(!auth()->user()->profile->cnic){
                toastr()->error("Complete your profile to complete your task!");
                return redirect()->back();
            }
            $count=$req->item_count;
            if($req->user_email==auth()->user()->email){
                toastr()->error("Seller cannot be customer");
                return redirect()->back();
            }
            $user = User::where('email', $req->user_email)->first();
            return view('Orders.custom-request',compact('count','user'));
    }

    public function store(Request $req){
        $req->validate([
            'artist_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'customer_email'=>'required|email',
            'customer_address'=>'required',
            'customer_tel'=>'required|phone:PK',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.img_src' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'customer_tel.phone' => 'Please enter a valid Pakistani phone number.',
        ]);
        if(!User::where('email',$req->customer_email)->exists()){
            $emailValidation=$this->emailValidator->validate($req->customer_email);
            if (
                !$emailValidation ||
                !$emailValidation['is_valid_format'] ||
                !$emailValidation['is_smtp_valid'] ||
                !$emailValidation['is_deliverable'] ||
                $emailValidation['is_disposable']
            ) {
                return back()->withErrors(['customer_email' => 'The email provided is invalid or undeliverable.'])->withInput();
            }
        }

        DB::beginTransaction();
        try{
        $order=Order::create([
            "payment_id"=>null,
            "type"=>"custom",
            "customer_id"=>$req->customer_id,
            "artist_id"=>$req->artist_id,
            "artist_address"=>User::find($req->artist_id)->profile->address,
            "user_contact"=>$req->customer_tel,
            "user_address"=>$req->customer_address,
            "customer_email"=>$req->customer_email,
            "order_date"=>now(),
            "payment_status"=>"UnPayed",
        ]);
        foreach($req->items as $item){
            $image=$item["img_src"]->store('order_items','public');
            $imageSrc=asset('storage/'.$image);

            OrderItem::create([
                "order_id"=>$order->id,
                "item_name"=>$item["item_name"],
                "price"=>$item["price"],
                "quantity"=>$item["quantity"],
                "total_price"=>($item["price"]+250)*$item["quantity"],
                "img_src"=>$imageSrc,
            ]);
        }
        DB::commit();

        $artist = User::find($req->artist_id);
        $admin = User::role('admin')->first();

        Mail::to($req->customer_email)->send(new OrderMail($order,$order->customer->name));
        Mail::to($artist->email)->send(new OrderMail($order,$artist->name));
        Mail::to($admin->email)->send(new OrderMail($order,$admin->name));

        toastr()->success('Your custom order has been placed.');
        return redirect()->route('artist.sales');
    }catch (\Exception $e) {
        DB::rollBack();
        toastr()->error('Order failed: ' . $e->getMessage());
        return back();
    }
    }
}
