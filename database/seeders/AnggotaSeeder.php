<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Bryan',
                'no_hp' => '081234567890',
                'email' => 'bryan@example.com',
                'alamat' => 'Jl. Merdeka No. 1, Jakarta',
                'tgl_bergabung' => now()->subDays(30)->toDateString(),
            ],
            [
                'nama' => 'Adit',
                'no_hp' => '081298765432',
                'email' => 'adit@example.com',
                'alamat' => 'Jl. Anggrek No. 10, Bandung',
                'tgl_bergabung' => now()->subDays(20)->toDateString(),
            ],
            [
                'nama' => 'Sari',
                'no_hp' => '081355501234',
                'email' => 'sari@example.com',
                'alamat' => 'Jl. Melati No. 5, Surabaya',
                'tgl_bergabung' => now()->subDays(10)->toDateString(),
            ],
        ];

        foreach ($data as $item) {
            Anggota::create($item);
        }
    }
}
