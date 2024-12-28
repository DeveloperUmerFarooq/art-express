<?php

namespace App\Http\Controllers;

use App\DataTables\ArtistDataTable;
use App\DataTables\UserDataTable;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCrud extends Controller
{
    public function user(UserDataTable $datatable){
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
        $req->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $req->id,
            'password' => 'nullable|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        try{
            $user=User::find($req->id);

                $user->name=$req->name;
                $user->email=$req->email;
                if($req->password!=null){
                    $user->password=Hash::make($req->password);
                }
                if($req->hasFile('image')){
                    if($user->profile->cloudinary_public_id){
                        Cloudinary::destroy($user->profile->cloudinary_public_id);
                    }
                    $path=Cloudinary::upload($req->file('image'),[
                        'folder'=>'avatars',
                        'transformation'=>[
                            'width'=>500,
                            'height'=>500,
                            'corp'=>'fill'
                        ]
                    ]);
                    $publicId=$path->getPublicId();
                    $path=$path->getSecurePath();
                    $user->profile()->update(['profile_image' => $path, 'cloudinary_public_id' => $publicId]);
                }
                $user->save();
                toastr()->success("User Updated Successfully!");
        }
        catch(Exception $error){
            toastr()->error("Failed Updating User!");
        }
            return redirect()->back();
    }
}
