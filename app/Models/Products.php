<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    public function blog(){
        return $this->hasOne(Blogs::class);
    }
    public function category(){
        return $this->hasOne(SubCategories::class);
    }
    public function image(){
        return  $this->hasOne(Images::class);
    }
    public function artist(){
        return $this->hasOne(User::class);
    }
}
