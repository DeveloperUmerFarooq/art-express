<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Comment;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index($id){
        $blog=Blogs::with('product.artist')->find($id);
        return view('blogs.index')->with(['blog'=>$blog]);
    }


    public function store(Request $req){
        $req->validate([
            'id'=>'required',
            'content'=>'required'
        ]);
        try{
            $product=Products::find($req->id);
            $product->blog()->create([
                'title' => $product->name,
                'content' => $req->content
            ]);
            toastr()->success('Post Added!');
        }catch(Exception $e){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
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

    public function comment(Request $request, $id){
            $request->validate([
                'comment' => 'required|string',
            ]);

            $post = Blogs::findOrFail($id);
            $post->comments()->create([
                'user_id' => auth()->user()->id,
                'content' => $request->comment,
            ]);

            return redirect()->back();
    }

    public function like($id){
            $post = Blogs::findOrFail($id);
            $user = auth()->user();
            $existingLike = $post->likes()->where('user_id', $user->id)->first();

            if ($existingLike) {
                $existingLike->delete();
            } else {
                $post->likes()->create([
                    'user_id' => $user->id,
                ]);
            }

            return $post->likes()->count();
    }

    public function delete($id){
        try{
            Blogs::find($id)->delete();
            toastr()->success('Post deleted');
        }catch(Exception $e){
            toastr()->error('Operation Failed!');
        }
        return redirect()->route('artist.product');
    }

    public function deleteComment($id){
        try{
            Comment::find($id)->delete();
            toastr()->success('Comment deleted');
        }catch(Exception $e){
            toastr()->error('Operation Failed!');
        }
        return redirect()->back();
    }
}
