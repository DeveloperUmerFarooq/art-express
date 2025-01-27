<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = User::with('images')->with(['products.image'])->find(auth()->user()->id);
        $profile = auth()->user()->profile;
        $images = $user->images->sortByDesc('id');;
        return view('artist.portfolio.index')->with(['images' => $images, 'profile' => $profile]);
    }

    public function addImage(Request $req)
    {
        $req->validate([
            'image' => 'required|mimes:peg,png,jpg,gif|max:2048'
        ]);
        $user = User::find($req->id);
        if ($req->hasFile('image')) {
            try {
                $image = $req->file('image');
                $filename = now()->timestamp . '_' . uniqid() . '.' . $image->extension();
                $image = ImageManager::gd()->read($image);
                $image->text("By: ".$user->name, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('font.ttf'));
                    $font->size(70);
                    $font->color('#495057');
                    $font->stroke('#f8f9fa', 1);
                    $font->align('center');
                    $font->lineHeight(1.6);
                });
                $path='portfolio/'.$filename;
                Storage::disk('public')->put($path, (string) $image->encode());
                $src=Storage::url($path);
                $user->images()->create([
                    'image_src' => $src
                ]);
                toastr()->success('New Image Added');
            } catch (Exception $e) {
                toastr()->error('Operation Failed');
            }
        }
        return redirect()->back();
    }

    public function deleteImage($id)
    {
        try {
            $image = Images::findOrFail($id);
            $relativePath = str_replace('/storage/', '', $image->image_src);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
            $image->delete();
            toastr()->success("Image Deleted!");
        } catch (Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
