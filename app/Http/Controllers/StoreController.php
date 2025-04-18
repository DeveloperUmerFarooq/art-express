<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $categories=Categories::with('products')->get();
        return view('products.store')->with('categories',$categories);
    }
    public function product($id){
        $product= Products::find($id);
        return view('products.view')->with(['product'=>$product]);
    }
    public function products($id){
        $category=Categories::with('subCategories.products','products')->find($id);
        $subCategories=$category->subCategories;
        $current=$category;
        $products=$category->products()->latest()->get();
        return view('products.products')->with(['category'=>$category,'subCategories'=>$subCategories,'products'=>$products,'current'=>$current]);
    }
    public function filtered($id, Request $req){
        $category=Categories::find($id);
        $subCategories=$category->subCategories;
        $current=$category;
        if($req->subcategory){
        $sub=SubCategories::find($req->subcategory);
        $products=$sub->products;
        $current=$sub;
        }else{
            $products=$category->products;
        }
        return view('products.products')->with(['category'=>$category,'subCategories'=>$subCategories,'products'=>$products,'subId'=>$sub->id??null,'current'=>$current]);
    }
    public function search(Request $req) {
        $products = Products::where('name', 'LIKE', "%{$req->name}%")->get();
        return view('products.search')->with(['products'=>$products]);
    }
}
