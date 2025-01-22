<?php

namespace App\Http\Controllers;

use App\DataTables\CategoriesDataTable;
use App\DataTables\SubCategoriesDataTable;
use App\Models\Categories;
use App\Models\SubCategories;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(CategoriesDataTable $datatable){
        return $datatable->render('admin.categories.categories');
    }

    public function sub(SubCategoriesDataTable $datatable,$id){
        $categories=Categories::all();
        return $datatable->subCategories($id)->render('admin.categories.subcategories',['categories'=>$categories]);
    }

    public function store(Request $req){
        $req->validate([
            'name'=>'required|unique:categories,name',
            'count'=>'min:0|integer|nullable',
            'subcategories'=>'array',
        ]);
        try{
            $category=Categories::create([
                'name'=>$req->name
            ]);
            if($req->count&&$req->count>0){
                $subcategories=array_map(function($item){
                    return ['name'=>$item];
                },$req->subcategories);
                $category->subCatagories()->createMany($subcategories);
            }
            toastr()->success('New Category created with '.$req->count.' Subcategories');
        }
        catch(Exception $e){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }

    public function subStore(Request $req){
            $req->validate([
                'name'=>'required',
                'category_id'=>'required'
            ]);
            try{
                SubCategories::create([
                    'name'=>$req->name,
                    'category_id'=>$req->category_id
                ]);
                toastr()->success('Subcategory Created Successfully!');
            }
            catch(Exception $e){
                toastr()->error('Operation Failed');
            }
            return redirect()->back();
    }
    public function delete($id){
        try{
            Categories::find($id)->delete();
            toastr()->success('Category Deleted Successfully');
        }
        catch(Exception $e){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }

    public function subDelete($id){
        try{
            SubCategories::find($id)->delete();
            toastr()->success('SubCategory Deleted Successfully');
        }
        catch(Exception $e){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }

    public function update(Request $req){
        $req->validate([
            'name'=>'required'
        ]);
        try{
            Categories::find($req->id)->update(['name'=>$req->name]);
            toastr()->success('Category Updated Successfully');
        }
        catch(Exception $e){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }

    public function subUpdate(Request $req){
        $req->validate([
            'Name'=>'required'
        ]);
        try{
            SubCategories::find($req->id)->update([
                'name'=>$req->Name
            ]);
            toastr()->success('SubCategory Updated Successfully');
        }
        catch(Exception $e){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }
}
