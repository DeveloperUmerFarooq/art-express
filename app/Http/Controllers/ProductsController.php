<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        $products = auth()->user()->products()->paginate(12);
        return view('artist.products.index')->with(['categories' => $categories, 'products' => $products]);
    }
    public function getCategory($id)
    {
        $subcategories = SubCategories::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    public function store(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'image' => 'required|mimes:peg,png,jpg,gif|max:2048'

        ]);
        if ($req->add_blog) {
            $req->validate([
                'content' => 'required'
            ]);
        }
        try {
            $product = Products::create([
                'name' => $req->title,
                'status' => 'Unsold',
                'artist_id' => auth()->user()->id,
                'category_id'=>$req->category,
                'sub_category_id' => $req->subcategory,
                'description' => $req->description,
                'price' => $req->price,
            ]);
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                $filename = now()->timestamp . '_' . uniqid() . '.' . $image->extension();
                $image = ImageManager::gd()->read($image);
                $image->text("By: " . auth()->user()->name, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('font.ttf'));
                    $font->size(70);
                    $font->color('#495057');
                    $font->stroke('#f8f9fa', 1);
                    $font->align('center');
                    $font->lineHeight(1.6);
                });
                $path = 'portfolio/' . $filename;
                Storage::disk('public')->put($path, (string) $image->encode());
                $src = Storage::url($path);
                $product->image()->create([
                    'artist_id' => auth()->user()->id,
                    'image_src' => $src
                ]);
            }
            if ($req->add_blog) {
                $product->blog()->create([
                    'title' => $req->title,
                    'content' => $req->content
                ]);
            }
            toastr()->success("Product Created!");
        } catch (Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    public function update(Request $req)
    {
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:peg,png,jpg,gif|max:2048'
        ]);
        try {
            $product = Products::find($req->id);
            $product->update([
                'name' => $req->title ?? $product->name,
                'description' => $req->description ?? $product->description,
                'price' => $req->price ?? $product->price,
            ]);
            if ($req->hasFile('image')) {
                $image = $product->image;
                $relativePath = str_replace('/storage/', '', $image->image_src);
                if (Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                }
                $image = $req->file('image');
                $filename = now()->timestamp . '_' . uniqid() . '.' . $image->extension();
                $image = ImageManager::gd()->read($image);
                $image->text("By: " . $product->artist->name, $image->width() / 2, $image->height() / 2, function ($font) {
                    $font->file(public_path('font.ttf'));
                    $font->size(70);
                    $font->color('#495057');
                    $font->stroke('#f8f9fa', 1);
                    $font->align('center');
                    $font->lineHeight(1.6);
                });
                $path = 'portfolio/' . $filename;
                Storage::disk('public')->put($path, (string) $image->encode());
                $src = Storage::url($path);
                $product->image()->update([
                    'image_src' => $src
                ]);
            }
            toastr()->success("Product Updated!");
        } catch (Exception $e) {
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }

    function delete($id)
    {
        try{
            $product = Products::find($id);
            $image = $product->image;
            $relativePath = str_replace('/storage/', '', $image->image_src);
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
            $product->delete();
            toastr()->success("Product Deleted Successfully!");
        }
        catch(Exception $e){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
}
