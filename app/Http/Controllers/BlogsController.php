<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Exception;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index($id){
        $blog=Blogs::with('product.artist')->find($id);
        return view('blogs.index')->with(['blog'=>$blog]);
    }

    public function update(Request $req,$id){
        $req->validate([
            'title'=>'required',
            'content'=>'required'
        ]);
        try{
            $blog=Blogs::find($id);
            $blog->update([
                'title'=>$req->title??$blog->title,
                'content'=>$req->content??$blog->content
            ]);
            toastr()->success("Post Updated!");
        }catch (Exception $e){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
