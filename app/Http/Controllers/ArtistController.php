<?php

namespace App\Http\Controllers;

use App\DataTables\SearchArtistDataTable;
use App\Models\Like;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artistId = auth()->user()->id;
        $totalLikes = Like::whereHas('post.product', function ($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })->count();
        $totalProducts = auth()->user()->products()->count();
        $user = User::with('products.blog')->find($artistId);
        $totalBlogs = $user->products->filter(fn($product) => $product->blog !== null)->count();

        $artist = User::with(['sales' => function ($query) {
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        }, 'sales.items'])->find($artistId);

        $totalSaleAmount= OrderItem::whereHas('order',function ($query) use ($artistId){
                $query->where('artist_id',$artistId);
        })->sum('price');

        $monthlySales = collect(range(1, 12))->map(function ($month) use ($artistId) {
            return OrderItem::whereHas('order', function ($query) use ($artistId, $month) {
                $query->where('artist_id', $artistId)
                      ->whereMonth('created_at', $month)
                      ->whereYear('created_at', now()->year);
            })->sum('price');
        });
        return view('artist.dashboard', compact('totalLikes', 'totalProducts', 'totalBlogs','totalSaleAmount','monthlySales'));
    }

    public function artist(SearchArtistDataTable $datatable)
    {
        return $datatable->render('artist.search');
    }
}
