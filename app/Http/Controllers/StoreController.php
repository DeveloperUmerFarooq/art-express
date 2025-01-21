<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $categories=Categories::all();
        return view('products.store')->with('categories',$categories);
    }
    public function products($id){
        $category=Categories::with('subCatagories')->find($id);
        $subCategories=$category->subCatagories;
        return view('products.products')->with(['category'=>$category,'subCategories'=>$subCategories]);
    }
}
