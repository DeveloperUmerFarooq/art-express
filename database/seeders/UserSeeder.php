<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=User::create([
            'name'=>'admin',
            'email'=>'admin@test.com',
            'avatar'=>'avatar.png',
            'password'=>Hash::make('admin1122')
        ]);
        $artist=User::create([
            'name'=>'artist',
            'email'=>'artist@text.com',
            'avatar'=>'avatar.png',
            'password'=>Hash::make('artist1122')
        ]);
        $user=User::create([
            'name'=>'user',
            'email'=>'user@text.com',
            'avatar'=>'avatar.png',
            'password'=>Hash::make('user1122')
        ]);
        $admin->assignRole('admin');
        $admin->profile()->create([
            'user_id'=>$admin->id
        ]);
        $artist->assignRole('artist');
        $artist->profile()->create([
            'user_id'=>$artist->id
        ]);
        $user->assignRole('user');
        $user->profile()->create([
            'user_id'=>$user->id
        ]);
    }
}
