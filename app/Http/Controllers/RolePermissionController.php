<?php

namespace App\Http\Controllers;

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
        $role=Role::findById($req->id);
        $role->syncPermissions($req->permissions);
        toastr()->success("Permisions for role:".$role->name." updated!");
        return redirect()->back();
    }
}
