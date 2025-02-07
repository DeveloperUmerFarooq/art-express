<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    /** @use HasFactory<\Database\Factories\SubCategoriesFactory> */
    use HasFactory;
    protected $fillable=['name','category_id'];
    public function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }
    public function products(){
        return $this->hasMany(Products::class,'sub_category_id');
    }
}
