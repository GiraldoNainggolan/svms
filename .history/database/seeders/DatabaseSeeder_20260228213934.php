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
                'name'=>'Super Admin',
                'email'=>'admin@svms.com',
                'password'=>Hash::make('password'),
                'role'=>'super_admin',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'Security',
                'email'=>'security@svms.com',
                'password'=>Hash::make('password'),
                'role'=>'security',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

            [
                'name'=>'Staff',
                'email'=>'staff@svms.com',
                'password'=>Hash::make('password'),
                'role'=>'staff',
                'created_at'=>now(),
                'updated_at'=>now(),
            ],

        ]);
    }
        $this->call([
        StaffSeeder::class,
        UserRoleSeeder::class,
    ]);
}