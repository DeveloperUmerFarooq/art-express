<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriesFactory> */
    use HasFactory;
    protected $fillable=['name'];
    public function subCategories(){
        return $this->hasMany(SubCategories::class,'category_id');
    }
    public function products(){
        return $this->hasManyThrough(Products::class,SubCategories::class,'category_id','sub_category_id','id','id');
    }
}
