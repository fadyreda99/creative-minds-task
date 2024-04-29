<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminRole = Role::first(['name' => 'admin']);

        // Create admin user
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'), // Change 'password' to your desired admin password
            // 'phone' => '01200737787'
        ]);

        // Assign admin role to admin user
        // $admin->assignRole($adminRole);

        // $this->command->info('Admin user created and assigned admin role successfully.');
    }
}
