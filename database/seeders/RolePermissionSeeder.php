<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view dashboard',
            'manage data',
            'upload data',
            'delete data'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions);
        $userRole->givePermissionTo(['view dashboard']);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@purwakarta.go.id',
            'password' => bcrypt('password123')
        ]);
        $admin->assignRole('admin');

        // Create regular user
        $user = User::create([
            'name' => 'User',
            'email' => 'user@purwakarta.go.id',
            'password' => bcrypt('password123')
        ]);
        $user->assignRole('user');
    }
}
