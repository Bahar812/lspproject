<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Dina',
                'email' => 'dina@perpus.test',
                'no_hp' => '081311110001',
                'posisi' => 'Admin',
            ],
            [
                'nama' => 'Rafi',
                'email' => 'rafi@perpus.test',
                'no_hp' => '081311110002',
                'posisi' => 'Petugas',
            ],
        ];

        foreach ($data as $item) {
            Staff::create($item);
        }
    }
}
