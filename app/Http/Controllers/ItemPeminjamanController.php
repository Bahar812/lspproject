<?php
namespace App\Http\Controllers;

use App\Models\ItemPeminjaman;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class ItemPeminjamanController extends Controller
{
    public function index()
    {
        $item_peminjaman = ItemPeminjaman::with('peminjaman', 'buku')->get();
        return view('item_peminjaman.index', compact('item_peminjaman'));
    }

    public function create()
    {
        $buku = Buku::all();
        $peminjaman = Peminjaman::all();
        return view('item_peminjaman.create', compact('buku', 'peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_peminjaman' => 'required',
            'tgl_kembali' => 'required|date',
        ]);

        ItemPeminjaman::create([
            'id_buku' => $request->id_buku,
            'id_peminjaman' => $request->id_peminjaman,
            'tgl_kembali' => $request->tgl_kembali,
        ]);

        return redirect()->route('item_peminjaman.index');
    }

    public function edit($id)
    {
        $item_peminjaman = ItemPeminjaman::findOrFail($id);
        $buku = Buku::all();
        $peminjaman = Peminjaman::all();
        return view('item_peminjaman.edit', compact('item_peminjaman', 'buku', 'peminjaman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_buku' => 'required',
            'id_peminjaman' => 'required',
            'tgl_kembali' => 'required|date',
        ]);

        $item_peminjaman = ItemPeminjaman::findOrFail($id);
        $item_peminjaman->update([
            'id_buku' => $request->id_buku,
            'id_peminjaman' => $request->id_peminjaman,
            'tgl_kembali' => $request->tgl_kembali,
        ]);

        return redirect()->route('item_peminjaman.index');
    }

    public function destroy($id)
    {
        $item_peminjaman = ItemPeminjaman::findOrFail($id);
        $item_peminjaman->delete();

        return redirect()->route('item_peminjaman.index');
    }
}
