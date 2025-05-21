<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions for 'admin'
        $adminPermissions = [
            'view art',
            'edit art',
            'delete art',
            'manage users',
            'manage permissions',
            'manage store',
            'manage artists',
            'manage profile',
            'manage categories',
            'manage subcategories',
            'manage blog',
            'cancel order',
            'create auction',
            'edit auction',
            'delete auction',
        ];

        // Create permissions for 'artist'
        $artistPermissions = [
            'create art',
            'edit art',
            'delete art',
            'view art',
            'buy art',
            'manage profile',
            'manage portfolio',
            'manage blog',
            'cancel order',
            'create auction',
            'edit auction',
            'delete auction',
        ];

        // Create permissions for 'user'
        $userPermissions = [
            'view art',
            'buy art',
            'manage profile',
            'cancel order'
        ];

        // Loop through the permission arrays and create permissions if they don't exist
        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($artistPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->syncPermissions($adminPermissions);

        $artistRole = Role::create(['name' => 'artist']);
        $artistRole->syncPermissions($artistPermissions);

        $userRole = Role::create(['name' => 'user']);
        $userRole->syncPermissions($userPermissions);
    }
}
