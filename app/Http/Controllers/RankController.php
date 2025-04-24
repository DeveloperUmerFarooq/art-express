<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index()
    {
        $topArtists = User::role('artist')
            ->withCount(['products', 'sales'])
            ->get()
            ->map(function ($user) {
                $sales = (float) $user->sales_count;
                $products = (float) $user->products_count;
                $user->ratio = $products > 0 ? $sales / $products : 0;

                return $user;
            })
            ->filter(function ($user) {
                return $user->products_count > 10 && $user->ratio > 0;
            })
            ->sortByDesc('ratio')
            ->take(10)
            ->values();

        return view('ranking.index', compact('topArtists'));
    }

}
