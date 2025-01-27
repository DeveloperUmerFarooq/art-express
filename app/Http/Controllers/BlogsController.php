<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index($id){
        $blog=Blogs::with('product.artist')->find($id);
        return view('blogs.index')->with(['blog'=>$blog]);
    }
}
