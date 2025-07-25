<?php

namespace App\Http\Controllers;

use App\Mail\OrderCancel;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\User;
use App\Rules\ContainsCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\EmailValidator;

class OrderController extends Controller
{
    protected $emailValidator,$delivery;
    public function __construct(EmailValidator $validate)
    {
        $this->emailValidator=$validate;
    }
    public function adminOrder()
    {
        $orders = Order::with(['items', 'customer', 'artist'])
            ->orderByRaw("FIELD(status, 'pending','in-progress','completed')")
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('Orders.index', compact('orders'));
    }
    public function index()
    {
        $orders = Order::with(['items', 'customer', 'artist'])
            ->where('customer_id', auth()->id())
            ->orderByRaw("FIELD(status, 'pending','in-progress','completed')")
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('Orders.index', compact('orders'));
    }

    public function sales()
    {
        $orders = Order::with(['items', 'customer', 'artist'])
            ->where('artist_id', auth()->id())
            ->orderByRaw("FIELD(status, 'pending', 'in-progress','completed')")
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('Orders.index', compact('orders'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'address' => ['required',new ContainsCity()],
            'tel' => 'required|phone:PK',
            'paymentMethod' => 'required',
            'customer_email'=>'required|email'
        ],[
            'tel.phone' => 'Please enter a valid Pakistani phone number.',
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

        $product = Products::find($req->product_id);
        $userCity = extractCityFromAddress($req->address);
        $artistCity= $product->artist->profile->city;
        $to=getCoordinates($userCity);
        $from=getCoordinates($artistCity);
        $distance=getDistanceInKm($from,$to);
        $this->delivery=deliverCharge($distance);
        if ($product->status == "Sold") {
            toastr()->info("Product is Sold");
            return redirect()->back();
        }
        if ($req->paymentMethod !== "card") {
            $this->placeOrder($req, $product);
        } else {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $charge = $stripe->charges->create([
                'amount' => ($product->price + $this->delivery) * 100,
                'currency' => 'pkr',
                'source' => $req->stripeToken,
                'description' => "payment for products"
            ]);
            if ($charge->status === 'succeeded') {
                $this->placeOrder($req, $product, $charge->id);
            } else {
                toastr()->error("Payment Process Failed!");
            }
        }
        return redirect()->back();
    }
    function placeOrder($req, $product, $id = null)
    {
        DB::beginTransaction();
        try {
            $order = Order::create([
                'payment_id' => $id,
                'type' => 'standard',
                'customer_id' => $req->customer_id,
                'artist_id' => $req->artist_id,
                'user_address' => $req->address,
                'customer_email'=>$req->customer_email,
                'artist_address' => User::find($req->artist_id)->profile->address,
                'user_contact' => $req->tel,
                'order_date' => now(),
                'payment_status' => $req->paymentMethod == 'card' ? 'Payed' : 'UnPayed',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $req->product_id,
                'item_name' => $product->name,
                'img_src' => $product->image->image_src,
                'price' => $product->price,
                'quantity' => 1,
                'total_price' => $product->price + $this->delivery,
            ]);
            $product->status = "Sold";
            $product->save();
            DB::commit();

            $artist = User::find($req->artist_id);
            $admin = User::role('admin')->first();

            Mail::to($req->customer_email)->send(new OrderMail($order,$order->customer->name));
            Mail::to($artist->email)->send(new OrderMail($order,$artist->name));
            Mail::to($admin->email)->send(new OrderMail($order,$admin->name));


            toastr()->success("Your Order Has Been Placed");
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error("Operation Failed");
        }
    }
    function cancel($id)
    {
        try {
            $order = Order::find($id);

            if (
                (auth()->user()->hasRole('admin') && $order->status === 'completed') ||
                (!auth()->user()->hasRole('admin') && in_array($order->status, ['in-progress', 'completed']))
            ) {
                toastr()->error("You are not allowed to cancel this order.");
                return redirect()->back();
            }

            if ($order->payment_id) {
                $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
                $amount = $order->items()->sum('total_price');
                $totalAmount = intval($amount);

                if (auth()->user()->hasRole('admin')) {
                    // Admin refund: no charges deducted
                    $refundAmount = $totalAmount;
                } else {
                    // Non-admin refund: 10% deduction + 100Rs fixed charge
                    $refundAmount = intval($totalAmount * 0.9);
                    $refundAmount -= 100;
                    if ($refundAmount < 0) {
                        $refundAmount = 0;
                    }
                }
                try {
                    $refund = $stripe->refunds->create([
                        'charge' => $order->payment_id,
                        'amount' => $refundAmount * 100,
                    ]);
                } catch (\Exception $e) {
                    toastr()->error("Refund Failed!");
                    return redirect()->back();
                }
            }
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product()->update([
                        'status' => 'Unsold'
                    ]);
                } else {
                    break;
                }
            }
            $admin = User::role('admin')->first();
            $artist = User::find($order->artist_id);
            Mail::to($order->customer_email)->send(new OrderCancel($order,$order->customer->name));
            Mail::to($order->artist->email)->send(new OrderCancel($order,$artist->name));
            Mail::to($admin->email)->send(new OrderCancel($order,$admin->name));
            $order->delete();
            toastr()->success("Order has been canceled");
        } catch (\Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function updateStatus($id, Request $req)
    {
        try {
            $order = Order::find($id);
            $order->status = $req->status;
            $order->save();
            toastr()->success("Status Updated Successfully!");
        } catch (\Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
