<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Flasher\Toastr\Prime\toastr;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PermissionDataTable $datatable)
    {
        return $datatable->render('admin.permission-management.permissions');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'roles'=>'required'
        ]);
        $permission = Permission::firstOrCreate(['name' => strtolower($req->name)]);
        if($permission->wasRecentlyCreated){
            toastr()->success("New Permission Created!");
            foreach($req->roles as $role){
                Role::findByName($role)->givePermissionTo($permission->name);
            }
        }else{
            toastr()->info("Permission Already Exist!");
        }
        return redirect()->back();
    }
    public function delete($id){
        try{
            Permission::findById($id)->delete();
            toastr()->success("Permission Deleted Successfully!");
        }catch(Exception $e){
            toastr()->error("Operation Failed!");
        }
        return redirect()->back();
    }
    public function update(Request $req){
            $req->validate([
                'name'=>'required'
            ]);
            $permission=Permission::findById($req->id);
            try{
                $permission->update(["name"=>$req->name]);
                toastr()->success("Permission Updated!");
            }catch(Exception $e){
                toastr()->error("Operation Failed");
            }
            return redirect()->back();
    }
}
