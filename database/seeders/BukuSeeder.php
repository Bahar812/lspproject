<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Pengantar Laravel',
                'pengarang' => 'Rizal Pratama',
                'tahun_terbit' => 2022,
                'penerbit' => 'Informatika Nusantara',
                'stok' => 6,
                'gambar' => 'photos/0r0kr8NBQhir09qqrT0rGXlvuYfQJSnuq5Z2oowx.png',
            ],
            [
                'judul' => 'Basis Data Modern',
                'pengarang' => 'Sinta Maharani',
                'tahun_terbit' => 2021,
                'penerbit' => 'Data Press',
                'stok' => 5,
                'gambar' => 'photos/5NwHdsa8iqhyejEouzTyfv5F7FSUlPtNy0hxqa5c.jpg',
            ],
            [
                'judul' => 'Pemrograman Web Praktis',
                'pengarang' => 'Aditya Kurniawan',
                'tahun_terbit' => 2020,
                'penerbit' => 'Web Studio',
                'stok' => 4,
                'gambar' => 'photos/fdHv86fyafXaKDSTqzW7ySidY0CQgKldddBcrxrH.png',
            ],
            [
                'judul' => 'Algoritma dan Struktur Data',
                'pengarang' => 'Nadia Putri',
                'tahun_terbit' => 2019,
                'penerbit' => 'Tekno Media',
                'stok' => 7,
                'gambar' => 'photos/fgxv0kDlZSJGl8OF4TxFVPO5NZrxOK2gmdLuGqNa.jpg',
            ],
            [
                'judul' => 'UI/UX untuk Pemula',
                'pengarang' => 'Fajar Santoso',
                'tahun_terbit' => 2023,
                'penerbit' => 'Desain Kita',
                'stok' => 3,
                'gambar' => 'photos/HgWPl2FCa8vA5e4PUKYWyV86TffawIPEdIRJxI8O.jpg',
            ],
            [
                'judul' => 'Manajemen Proyek IT',
                'pengarang' => 'Indah Lestari',
                'tahun_terbit' => 2018,
                'penerbit' => 'Project Lab',
                'stok' => 2,
                'gambar' => 'photos/MryphmJKSsfHwUviBXriKv5m3zqeXSmdV5D07CLH.jpg',
            ],
        ];

        foreach ($data as $item) {
            Buku::create($item);
        }
    }
}
