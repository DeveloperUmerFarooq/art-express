<?php

namespace App\Http\Controllers;

use App\DataTables\SearchArtistDataTable;
use App\Models\Auction;
use App\Models\Like;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function index()
    {
        return view('artist.dashboard');
    }

    public function getDashboardStats()
    {
        $artistId = auth()->user()->id;
        $auctions= Auction::where('host_id',auth()->id())->count();

        $totalLikes = Like::whereHas('post.product', function ($query) use ($artistId) {
            $query->where('artist_id', $artistId);
        })->count();

        $totalProducts = auth()->user()->products()->count();

        $totalBlogs = auth()->user()->products()->whereHas('blog')->count();

        $artist = User::with([
            'sales' => function ($query) {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->with('items');
            }
        ])->find($artistId);

        $currentMonthSales = $artist->sales->flatMap(fn($sale) => $sale->items)->sum(fn($item) => $item->price * $item->quantity);

        $totalSalesAmount = Order::where('artist_id', $artistId)
            ->with('items')
            ->get()
            ->flatMap(fn($order) => $order->items)
            ->sum(fn($item) => $item->price * $item->quantity);




        $monthlySales = collect(range(1, 12))->map(function ($month) use ($artistId) {
            return OrderItem::whereHas('order', function ($query) use ($artistId, $month) {
                $query->where('artist_id', $artistId)
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', now()->year);
            })
                ->sum(DB::raw('price * quantity'));
        });

        $auctionsStatus=Auction::where('host_id',auth()->id())->selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count','status')->toArray();
        $auctionLabels=["upcoming","ongoing","ended"];
        $auctionsData=[];
        foreach($auctionLabels as $label){
            $auctionsData[]=$auctionsStatus[$label]??0;
        }

        return response()->json([
        'auctions' => $auctions,
        'totalLikes' => $totalLikes,
        'totalProducts' => $totalProducts,
        'totalBlogs' => $totalBlogs,
        'monthlySales' => $monthlySales,
        'currentMonthSales' => $currentMonthSales,
        'totalSalesAmount' => $totalSalesAmount,
        'auctionsData' => $auctionsData,
    ]);
    }

    public function artist(SearchArtistDataTable $datatable)
    {
        return $datatable->render('artist.search');
    }
}
