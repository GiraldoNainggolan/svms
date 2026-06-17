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
                // 'nik' => '3526011201800001',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Sinta Maharani',
                'position' => 'Wakil Kepala Sekolah',
                // 'nim' => '3526014502850002',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Andi Wijaya',
                'position' => 'Guru Matematika',
                // 'nik' => '3526011703900003',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Rani Pratiwi',
                'position' => 'Guru Bahasa Indonesia',
                'nik' => '3526015204950004',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Dedi Kurniawan',
                'position' => 'Guru Informatika',
                'nik' => '3526012107880005',
                
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Bu Lina Astuti',
                'position' => 'Tata Usaha',
                'nik' => '3526016309900006',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Pak Hendra Saputra',
                'position' => 'Keamanan',
                'nik' => '3526011401850007',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}