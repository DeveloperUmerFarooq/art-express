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
        $artist->assignRole('artist');
        $user->assignRole('user');

    }
}
