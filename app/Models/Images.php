<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    /** @use HasFactory<\Database\Factories\ImagesFactory> */
    use HasFactory;
    protected $fillable=['image_src','product_id','artist_id'];
    public function artist(){
        return $this->hasOne(User::class);
    }
}
