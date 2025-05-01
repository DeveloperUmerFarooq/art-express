<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailValidator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo;
    protected $emailValidator;

    public function __construct(EmailValidator $validator)
    {
        $this->middleware('guest');
        $this->emailValidator = $validator;
    }

    /**
     * Validate registration input
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name'       => ['required', 'string', 'max:255'],
            'reg_email'  => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'role'       => ['required']
        ]);

        $validator->after(function ($validator) use ($data) {
            $emailValidation = $this->emailValidator->validate($data['reg_email']);

            if (
                !$emailValidation ||
                !$emailValidation['is_valid_format'] ||
                !$emailValidation['is_smtp_valid'] ||
                !$emailValidation['is_deliverable']
            ) {
                $validator->errors()->add('reg_email', 'The email provided is invalid or undeliverable.');
            }
        });

        return $validator;
    }

    /**
     * Create a new user instance
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['reg_email'],
            'avatar'   => 'avatar.png',
            'password' => Hash::make($data['password']),
        ]);

        $user->profile()->create();
        $user->assignRole($data['role']);

        return $user;
    }

    /**
     * Redirect user after registration based on role
     */
    protected function redirectTo()
    {
        $role = Auth::user()->getRoleNames()->first();

        return match ($role) {
            'admin'  => '/admin/dashboard',
            'user'   => '/user/dashboard',
            'artist' => '/artist/dashboard',
            default  => '/',
        };
    }
}
