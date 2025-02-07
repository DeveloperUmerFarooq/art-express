<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    protected $guarded=[];
    public function blog(){
        return $this->hasOne(Blogs::class,'product_id');
    }
    public function category(){
        return $this->hasOne(Categories::class,'category_id');
    }
    public function subCategory()
    {   
        return $this->belongsTo(SubCategories::class, 'sub_category_id');
    }
    public function image(){
        return  $this->hasOne(Images::class,'product_id');
    }
    public function artist(){
        return $this->belongsTo(User::class,'artist_id');
    }
}
