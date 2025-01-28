<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    /** @use HasFactory<\Database\Factories\BlogsFactory> */
    use HasFactory;
    protected $guarded=[];
    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'post_id')->orderBy('created_at', 'desc');;
    }

    public function likes(){
        return $this->hasMany(Like::class,'post_id');
    }
}
