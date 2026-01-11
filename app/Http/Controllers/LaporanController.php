<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $peminjaman_aktif = Peminjaman::where('tgl_kembali', '>=', Carbon::today())->get();

        $peminjaman_jatuh_tempo = Peminjaman::where('tgl_kembali', '<', Carbon::today())->get();

        return view('laporan.index', compact('peminjaman_aktif', 'peminjaman_jatuh_tempo'));
    }
}
