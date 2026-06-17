<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::insert([

            [
                'name' => 'Pak Budi Santoso',
                'position' => 'Kepala Sekolah',
                'nik' => '3526011201800001',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Sinta Maharani',
                'position' => 'Wakil Kepala Sekolah',
                'nim' 
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Andi Wijaya',
                'position' => 'Guru Matematika',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Rani Pratiwi',
                'position' => 'Guru Bahasa Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Dedi Kurniawan',
                'position' => 'Guru Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Lina Astuti',
                'position' => 'Tata Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Hendra Saputra',
                'position' => 'Keamanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}