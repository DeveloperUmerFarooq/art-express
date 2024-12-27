<?php

namespace App\Http\Controllers;

use App\DataTables\ArtistDataTable;
use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserCrud extends Controller
{
    public function user(UsersDataTable $datatable){
            return $datatable->render('admin.user-management.user');
    }

    public function artist(ArtistDataTable $datatable){
            return $datatable->render('admin.user-management.artist');
    }
    public function delete($id){
        User::find($id)->delete();
        toastr()->success('User Deleted!');
        return redirect()->back();
    }
    public function addArtist(Request $req){
        $user=User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>$req->password,
        ]);
        $user->assignRole('artist');
        $user->profile()->create([
            'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
        ]);
        toastr()->success('New Artist Created');
        return redirect()->back();
    }
}
