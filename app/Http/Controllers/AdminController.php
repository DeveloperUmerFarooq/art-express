<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Blogs;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getDashboardStats(){
        $monthlyUsers = collect(range(1, 12))->map(function ($month) {
            return User::whereMonth('created_at', $month)->whereYear('created_at', now()->year)
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->count();
        })->toArray();

        $monthlySales = collect(range(1, 12))->map(function ($month) {
            return Order::whereMonth('created_at', $month)->whereYear('created_at', now()->year)->with('items')->get()->flatMap->items->sum('total_price');
        })->toArray();

        $users = User::Role('user')->count();
        $artists = User::Role('artist')->count();
        $orders=Order::count();
        $auctions=Auction::count();
        $hostedAuction=Auction::where('host_id',auth()->id())->count();
        $activeUsers=User::where('status',0)->count();
        $suspendedUsers=User::where('status',1)->count();

        $sales = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->with('items')->get()->flatMap->items->sum('total_price');

        $totalSales = Order::whereYear('created_at', now()->year)->with('items')->get()->flatMap->items->sum('total_price');

        $ordersStatus=Order::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count','status')->toArray();
        $orderLabels=["pending","in-progress","completed"];
        $ordersData=[];
        foreach($orderLabels as $label){
            $ordersData[]=$ordersStatus[$label]??0;
        }

        $auctionsStatus=Auction::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count','status')->toArray();
        $auctionLabels=["upcoming","ongoing","ended"];
        $auctionsData=[];
        foreach($auctionLabels as $label){
            $auctionsData[]=$auctionsStatus[$label]??0;
        }

        $products = Products::count();
        $blogs = Blogs::count();
        return response()->json([
        'monthlyUsers' => $monthlyUsers,
        'monthlySales' => $monthlySales,
        'users' => $users,
        'artists' => $artists,
        'orders' => $orders,
        'auctions' => $auctions,
        'ordersData'=>$ordersData,
        'auctionsData'=>$auctionsData,
        'hostedAuctions' => $hostedAuction,
        'sales' => $sales,
        'totalSales' => $totalSales,
        'products' => $products,
        'blogs' => $blogs,
        'activeUsers' => $activeUsers,
        'suspendedUsers' => $suspendedUsers,
    ]);
    }
}
