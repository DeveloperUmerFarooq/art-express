<?php

namespace App\Http\Controllers;

use App\DataTables\ArtistDataTable;
use App\DataTables\UsersDataTable;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Controller
{
    public function user(UsersDataTable $datatable){
            return $datatable->render('admin.user-management.user');
    }

    public function artist(ArtistDataTable $datatable){
            return $datatable->render('admin.user-management.artist');
    }
    public function delete($id){
        try{
            User::find($id)->delete();
            toastr()->success('User Deleted!');
        }
        catch(Exception $error){
            toastr()->error('Operation Failed');
        }
        return redirect()->back();
    }
    public function addArtist(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);
        try{
            $user=User::create([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
            ]);
            $user->assignRole('artist');
            $user->profile()->create([
                'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
            ]);
            toastr()->success('New Artist Created');
        }
        catch(Exception $error){
            toastr()->error('Artist Creation Failed');
        }
        return redirect()->back();
    }
    public function addUser(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);
        try{
            $user=User::create([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
            ]);
            $user->assignRole('user');
            $user->profile()->create([
                'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
            ]);
            toastr()->success('New User Created');
        }
        catch(Exception $error){
            toastr()->error("User Creation Failed!");
        }
        return redirect()->back();
    }
    public function editUsers(Request $req){
        $user=User::find($req->id);

            $user->name=$req->name??$req->name;
            $user->email=$req->email??$req->email;
            $user->password=$req->password??Hash::make($req->password);
            $user->save();
            return redirect()->back();
    }
}
