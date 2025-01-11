<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(){
        $roles=Role::all();
        $permissions=Permission::all();
        return view('admin.role-management.role')->with(['roles'=>$roles,'permissions'=>$permissions]);
    }
    public function update(Request $req){
        // dd($req->toArray());
        $req->validate([
            'permissions'=>'required'
        ]);
        try{
            $role=Role::findById($req->id);
            $role->syncPermissions($req->permissions);
            toastr()->success("Permisions for role:".$role->name." updated!");
        }catch(Exception $e){
            toastr()->error("Operation Failed");
        }
        return redirect()->back();
    }
}
