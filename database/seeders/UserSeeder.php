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
            'password'=>Hash::make('admin1122')
        ]);
        $artist=User::create([
            'name'=>'artist',
            'email'=>'artist@text.com',
            'password'=>Hash::make('artist1122')
        ]);
        $user=User::create([
            'name'=>'user',
            'email'=>'user@text.com',
            'password'=>Hash::make('user1122')
        ]);
        $admin->assignRole('admin');
        $admin->profile()->create([
            'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($admin->name),
        ]);
        $artist->assignRole('artist');
        $artist->profile()->create([
            'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($artist->name),
        ]);
        $user->assignRole('user');
        $user->profile()->create([
            'profile_image' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name),
        ]);

    }
}
