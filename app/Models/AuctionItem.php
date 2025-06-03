<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    /** @use HasFactory<\Database\Factories\AuctionItemFactory> */
    use HasFactory;
    protected $guarded=[];

    public function auction(){
        return $this->belongsTo(Auction::class,'auction_id');
    }
    public function winner(){
        return $this->belongsTo(User::class,'winner_id');
    }
}
