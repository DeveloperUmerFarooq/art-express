<?php

namespace App\Http\Controllers;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $profile=auth()->user()->profile;
        return view('profile.profile')->with('profile',$profile);
    }

    public function addSocialLinks(Request $req){
        $req->validate([
            'facebook'=>'nullable|url',
            'instagram'=>'nullable|url',
            'twitter'=>'nullable|url',
            'linkedin'=>'nullable|url'
        ]);
        $user=User::find($req->id);
        $profile=$user->profile;
        $profile->facebook_link = $req->facebook;
        $profile->instagram_link = $req->instagram;
        $profile->twitter_link = $req->twitter;
        $profile->linkedin_link = $req->linkedin;
        $profile->save();
        toastr()->info('Profile Links Added!');
        return redirect()->back();
    }

    public function editSocailLinks(Request $req){
        $req->validate([
            'facebook'=>'nullable|url',
            'instagram'=>'nullable|url',
            'twitter'=>'nullable|url',
            'linkedin'=>'nullable|url'
        ]);
        $user=User::find($req->id);
        $profile=$user->profile;
        $profile->facebook_link = $req->facebook ?? $profile->facebook_link;
        $profile->instagram_link = $req->instagram ?? $profile->instagram_link;
        $profile->twitter_link = $req->twitter ?? $profile->twitter_link;
        $profile->linkedin_link = $req->linkedin ?? $profile->linkedin_link;
        $profile->save();
        toastr()->info('Profile Links Updated!');
        toastr()->success('Profile Links Updated Successfully!');
        return redirect()->back();
    }

    public function updateAvatar(Request $req){
        $req->validate([
            'avatar'=>'required|mimes:peg,png,jpg,gif|max:2048'
        ]);
        $user=User::find($req->id);
        if($req->hasFile('avatar')){
            try{
                if($user->profile->cloudinary_public_id){
                    Cloudinary::destroy($user->profile->cloudinary_public_id);
                }
                $path=Cloudinary::upload($req->file('avatar'),[
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
                toastr()->success('Profile Successfully Updated!');
            }
            catch(Exception $error){
                toastr()->error("Failed to update the profile-image");
            }
        }
        return redirect()->back();
    }
}
