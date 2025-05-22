<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded=[];
    protected $table = 'registerations';
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function auction(){
        return $this->belongsTo(Auction::class);
    }
}
