<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\ItemPeminjaman;
use App\Models\Anggota;
use App\Models\Staff;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('anggota', 'staff')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $staff = Staff::all();
        $buku = Buku::all(); 
        $tgl_pinjam = now()->toDateString();
        $tgl_kembali = now()->addDays(7)->toDateString();

        return view('peminjaman.create', compact('anggota', 'staff', 'buku', 'tgl_pinjam', 'tgl_kembali'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_staff' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
            'buku_ids' => 'required|array', 
        ]);

        $peminjaman = Peminjaman::create([
            'id_anggota' => $request->id_anggota,
            'id_staff' => $request->id_staff,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
        ]);

        foreach ($request->buku_ids as $buku_id) {
            $buku = Buku::find($buku_id);

            
            if ($buku && $buku->stok > 0) {
                $buku->stok -= 1;
                $buku->save(); 

                ItemPeminjaman::create([
                    'id_peminjaman' => $peminjaman->id,
                    'id_buku' => $buku_id,
                    'tgl_kembali' => $request->tgl_kembali,
                ]);
            } else {
                return back()->withErrors([
                    'buku_ids' => 'Stok buku ' . $buku->judul . ' habis.',
                ]);
            }
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan!');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $anggota = Anggota::all();
        $staff = Staff::all();
        return view('peminjaman.edit', compact('peminjaman', 'anggota', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_staff' => 'required',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'id_anggota' => $request->id_anggota,
            'id_staff' => $request->id_staff,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
        ]);

        return redirect()->route('peminjaman.index');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index');
    }
}
