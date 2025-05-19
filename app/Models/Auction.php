<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    /** @use HasFactory<\Database\Factories\AuctionFactory> */
    use HasFactory;
    protected $guarded=[];

    public function items(){
        return $this->hasMany(AuctionItem::class,'auction_id');
    }
    public function host(){
        return $this->belongsTo(User::class,'host_id');
    }
}
