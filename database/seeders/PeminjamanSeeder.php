<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\ItemPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $anggotaId = DB::table('anggota')->pluck('id')->all();
        $staffId = DB::table('staff')->pluck('id')->all();

        if (empty($anggotaId) || empty($staffId)) {
            return;
        }

        $buku = Buku::orderBy('id')->get();

        if ($buku->isEmpty()) {
            return;
        }

        $loans = [
            [
                'id_anggota' => $anggotaId[0],
                'id_staff' => $staffId[0],
                'tgl_pinjam' => now()->subDays(6)->toDateString(),
                'tgl_kembali' => now()->addDays(1)->toDateString(),
                'tgl_dikembalikan' => null,
                'buku_ids' => [$buku[0]->id, $buku[1]->id],
            ],
            [
                'id_anggota' => $anggotaId[1] ?? $anggotaId[0],
                'id_staff' => $staffId[1] ?? $staffId[0],
                'tgl_pinjam' => now()->subDays(10)->toDateString(),
                'tgl_kembali' => now()->subDays(3)->toDateString(),
                'tgl_dikembalikan' => now()->subDays(2)->toDateString(),
                'buku_ids' => [$buku[2]->id],
            ],
            [
                'id_anggota' => $anggotaId[2] ?? $anggotaId[0],
                'id_staff' => $staffId[0],
                'tgl_pinjam' => now()->subDays(2)->toDateString(),
                'tgl_kembali' => now()->addDays(5)->toDateString(),
                'tgl_dikembalikan' => null,
                'buku_ids' => [$buku[3]->id, $buku[4]->id],
            ],
        ];

        foreach ($loans as $loan) {
            DB::transaction(function () use ($loan) {
                $peminjaman = Peminjaman::create([
                    'id_anggota' => $loan['id_anggota'],
                    'id_staff' => $loan['id_staff'],
                    'tgl_pinjam' => $loan['tgl_pinjam'],
                    'tgl_kembali' => $loan['tgl_kembali'],
                    'tgl_dikembalikan' => $loan['tgl_dikembalikan'],
                ]);

                foreach ($loan['buku_ids'] as $bukuId) {
                    $buku = Buku::find($bukuId);

                    if (!$buku || $buku->stok <= 0) {
                        continue;
                    }

                    $buku->decrement('stok');

                    ItemPeminjaman::create([
                        'id_peminjaman' => $peminjaman->id,
                        'id_buku' => $bukuId,
                        'tgl_kembali' => $loan['tgl_kembali'],
                    ]);

                    if ($loan['tgl_dikembalikan']) {
                        $buku->increment('stok');
                    }
                }
            });
        }
    }
}
