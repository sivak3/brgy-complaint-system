<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'resident']);

        // Create admin account
        $admin = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@brgy.com',
            'password' => Hash::make('admin123'),
        ]);

        // Assign admin role
        $admin->assignRole('admin');
    }
}