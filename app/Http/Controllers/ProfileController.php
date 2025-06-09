<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\ContainsCity;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\EmailValidator;

class ProfileController extends Controller
{
    protected $emailValidator;
    public function __construct(EmailValidator $validate)
    {
        $this->emailValidator=$validate;
    }
    public function index()
    {
        $profile = auth()->user()->profile;
        return view('profile.profile')->with('profile', $profile);
    }


    public function portfolio($id)
    {
        $user = User::with('profile', 'images')->find($id);
        $profile = $user->profile;
        $images = $user->images;
        return view('artist.portfolio.portfolio')->with(['profile' => $profile, 'images' => $images]);
    }
    public function profile($id)
    {
        $user = User::with('profile', 'images')->find($id);
        $profile = $user->profile;
        return view('profile.view')->with(['profile' => $profile]);
    }
    public function addSocialLinks(Request $req)
    {
        $req->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url'
        ]);
        $user = User::find($req->id);
        $profile = $user->profile;
        $profile->facebook_link = $req->facebook;
        $profile->instagram_link = $req->instagram;
        $profile->twitter_link = $req->twitter;
        $profile->linkedin_link = $req->linkedin;
        $profile->save();
        toastr()->info('Profile Links Added!');
        return redirect()->back();
    }

    public function editSocailLinks(Request $req)
    {
        $req->validate([
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url'
        ]);
        $user = User::find($req->id);
        $profile = $user->profile;
        $profile->facebook_link = $req->facebook;
        $profile->instagram_link = $req->instagram;
        $profile->twitter_link = $req->twitter;
        $profile->linkedin_link = $req->linkedin;
        $profile->save();
        toastr()->info('Profile Links Updated!');
        toastr()->success('Profile Links Updated Successfully!');
        return redirect()->back();
    }

    public function updateAvatar(Request $req)
    {
        $req->validate([
            'avatar' => 'required|mimes:peg,png,jpg,gif|max:2048'
        ]);
        $user = User::find($req->id);
        if ($req->hasFile('avatar')) {
            try {
                if ($user->avatar!=="avatar.png" && Storage::disk('public')->exists('users-avatar/'.$user->avatar)) {
                    Storage::disk('public')->delete('users-avatar/' . $user->avatar);
                }
                $avatar = $req->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->storeAs('users-avatar', $avatarName,'public');
                $user->avatar=$avatarName;
                $user->save();
                toastr()->success('Profile Successfully Updated!');
            } catch (Exception $error) {
                toastr()->error("Failed to update the profile-image");
            }
        }
        return redirect()->back();
    }
    public function updateDetails(Request $req)
    {
        $req->validate([
            'email' => 'email|required',
            'name' => 'required',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/',
            'phone_number' => 'required|phone:PK',
            'address' => ['required',new ContainsCity()],
            'city' => ['required',new ContainsCity()],
        ],[
            'phone_number.phone' => 'Please enter a valid Pakistani phone number.',
            'cnic.required' => 'The CNIC field is required.',
            'cnic.regex' => 'The CNIC format must be 12345-1234567-1.',
        ]);

        if(!User::where('email',$req->email)->exists()){
            $emailValidation=$this->emailValidator->validate($req->email);
            if (
                !$emailValidation ||
                !$emailValidation['is_valid_format'] ||
                !$emailValidation['is_smtp_valid'] ||
                !$emailValidation['is_deliverable'] ||
                $emailValidation['is_disposable']
            ) {
                return back()->withErrors(['email' => 'The email provided is invalid or undeliverable.'])->withInput();
            }
        }

        $user = User::find($req->id);
        $profile = $user->profile;
        $user->update([
            'name' => $req->name ?? $user->name,
            'email' => $req->email ?? $user->email,
        ]);
        $user->profile()->update([
            'bio' => $req->bio ?? $profile->bio,
            'cnic' => $req->cnic ?? $profile->cnic,
            'city' => $req->city ?? $profile->city,
            'country' => "Pakistan",
            'address' => $req->address ?? $profile->address,
            'phone_number' => $req->phone_number ?? $profile->phone_number
        ]);
        toastr()->success("Details Updated Successfully");
        return redirect()->back();
    }
    public function updatePassword(Request $req)
    {
        $req->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::find($req->id);
        if (!Hash::check($req->current_password, $user->password)) {
            toastr()->error("Current Passowrd is incorrect!");
            return redirect()->back();
        }
        $user->update([
            'password' => $req->password
        ]);
        toastr()->success("Password Updated Successfully!");
        return redirect()->back();
    }
}
