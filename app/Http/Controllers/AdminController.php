<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

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

        $sales = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->with('items')->get()->flatMap->items->sum('total_price');

        $totalSales = Order::whereYear('created_at', now()->year)->with('items')->get()->flatMap->items->sum('total_price');

        $products = Products::count();
        $blogs = Blogs::count();

        return view('admin.dashboard', compact('sales', 'totalSales', 'users', 'artists', 'products', 'blogs', 'monthlyUsers', 'monthlySales'));
    }
}
