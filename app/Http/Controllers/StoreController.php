<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $categories=Categories::with('products')->get();
        return view('products.store')->with('categories',$categories);
    }
    public function products($id){
        $category=Categories::with('subCategories.products')->find($id);
        $subCategories=$category->subCategories;
        return view('products.products')->with(['category'=>$category,'subCategories'=>$subCategories]);
    }
}
