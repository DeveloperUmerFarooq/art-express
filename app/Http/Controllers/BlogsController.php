<?php

namespace App\Http\Controllers;

use App\Events\LikePost;
use App\Events\PostComment;
use App\Jobs\Like;
use App\Jobs\PostComment as JobsPostComment;
use App\Models\Blogs;
use App\Models\Comment;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index($id)
    {
        $blog = Blogs::with(['product.artist'])->findOrFail($id);


        $comments = $blog->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('blogs.index', [
            'blog' => $blog,
            'comments' => $comments
        ]);
    }

    public function loadMoreComments($id)
    {
        $blog = Blogs::findOrFail($id);
        $comments = $blog->comments()
            ->with('user')
            ->latest()
            ->paginate(5, ['*'], 'page', request()->page);

        return response()->json([
            'html' => view('blogs.partials.comments', ['comments' => $comments])->render(),
            'hasMore' => $comments->hasMorePages()
        ]);
    }


    public function store(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'content' => 'required'
        ]);
        try {
            $product = Products::find($req->id);
            $product->blog()->create([
                'title' => $product->name,
                'content' => $req->content
            ]);
            toastr()->success('Post Added!');
        } catch (Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        try {
            $blog = Blogs::find($id);
            $blog->update([
                'title' => $req->title ?? $blog->title,
                'content' => $req->content ?? $blog->content
            ]);
            toastr()->success("Post Updated!");
        } catch (Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $post = Blogs::findOrFail($id);
        $comment = $post->comments()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->comment,
        ]);
        dispatch(new JobsPostComment($comment, auth()->user(), $post->comments()->count(), $comment->updated_at->diffForHumans(), $post->id))->afterResponse();
        return response()->json(['message' => "Comment Deleted"]);
    }

    public function like($id)
    {
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
        dispatch(new Like($post->likes()->count(), $post->id))->afterResponse();
        return response()->json(['likes' => $post->likes()->count()]);
    }

    public function delete($id)
    {
        try {
            Blogs::find($id)->delete();
            toastr()->success('Post deleted');
        } catch (Exception $e) {
            toastr()->error('Operation Failed!');
        }
        return redirect()->route('artist.product');
    }

    public function deleteComment($id)
    {
        try {
            Comment::find($id)->delete();
            toastr()->success('Comment deleted');
        } catch (Exception $e) {
            toastr()->error('Operation Failed!');
        }
        return redirect()->back();
    }
}
