<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name'       => 'Super Admin',
                'email'      => 'admin@svms.com',
                'password'   => Hash::make('password'),
                'role'       => 'super_admin',
                'nik'        => '0000000000000001',
                'position'   => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Security Dummy',
                'email'      => 'security@svms.com',
                'password'   => Hash::make('password'),
                'role'       => 'security',
                'nik'        => '0000000000000002',
                'position'   => 'Keamanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Staff Dummy',
                'email'      => 'staff@svms.com',
                'password'   => Hash::make('password'),
                'role'       => 'staff',
                'nik'        => '0000000000000003',
                'position'   => 'Guru Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
