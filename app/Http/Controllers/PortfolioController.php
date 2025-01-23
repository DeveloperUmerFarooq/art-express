<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index(){
        $user=User::with('images')->with(['products.image'])->find(auth()->user()->id);
        $profile=auth()->user()->profile;
        $images=$user->images->sortByDesc('id'); ;
        return view('artist.portfolio.index')->with(['images'=>$images,'profile'=>$profile]);
    }

    public function addImage(Request $req){
        $req->validate([
            'image'=>'required|mimes:peg,png,jpg,gif|max:2048'
        ]);
        $user=User::find($req->id);
        if($req->hasFile('image')){
            try{
                $path=$req->file('image')->store('portfolio','public');
                $src=asset('storage/'.$path);
                $user->images()->create([
                    'image_src'=>$src
                ]);
                toastr()->success('New Image Added');
            }catch(Exception $e){
                toastr()->success('Operation Failed');
            }
        }
        return redirect()->back();
    }

    public function deleteImage($id){
        try{
        $image = Images::findOrFail($id);
        $relativePath = str_replace(url('storage') . '/', '', $image->image_src);
        // dd($relativePath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
        $image->delete();
        toastr()->success("Image Deleted!");
        }
        catch(Exception $e){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
