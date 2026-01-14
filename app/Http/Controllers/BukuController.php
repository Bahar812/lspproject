<?php
namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user && $user->role === 'anggota') {
            $anggota = Anggota::where('email', $user->email)->first();
            $peminjamanAnggota = collect();

            if ($anggota) {
                $peminjamanAnggota = Peminjaman::with('itemPeminjaman.buku')
                    ->where('id_anggota', $anggota->id)
                    ->orderByDesc('tgl_pinjam')
                    ->get();
            }

            return view('page.dashboard', [
                'userRole' => 'anggota',
                'anggota' => $anggota,
                'peminjamanAnggota' => $peminjamanAnggota,
            ]);
        }

        $query = $request->query('q');
        $buku = Buku::query()
            ->when($query, function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('pengarang', 'like', "%{$query}%")
                    ->orWhere('penerbit', 'like', "%{$query}%")
                    ->orWhere('tahun_terbit', 'like', "%{$query}%");
            })
            ->get();

        $totalBuku = Buku::count();
        $totalStok = Buku::sum('stok');
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Peminjaman::whereNull('tgl_dikembalikan')->count();

        return view('page.dashboard', [
            'userRole' => 'admin',
            'buku' => $buku,
            'query' => $query,
            'totalBuku' => $totalBuku,
            'totalStok' => $totalStok,
            'totalAnggota' => $totalAnggota,
            'peminjamanAktif' => $peminjamanAktif,
        ]);
    }

     public function katalog(Request $request)
{
    $query = $request->input('query'); 

    if ($query) {
        $buku = Buku::where('judul', 'like', "%{$query}%")
                    ->orWhere('pengarang', 'like', "%{$query}%")
                    ->get();
    } else {
        $buku = Buku::all();
    }

    return view('page.catalog', compact('buku'));
}

    public function create()
    {
        return view('page.form');
    }

    public function store(Request $request)
    {
        $gambarPath = null;
        if($request->hasFile('gambar')){
            $gambarPath = $request->file('gambar')->store('photos','public');
        }

        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'penerbit' => 'required',
            'stok' => 'required',
            'gambar' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // $gambarPath = $request->file('gambar')->store('public/gambar_buku');

        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit' => $request->penerbit,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('buku.index');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('page.form', compact('buku'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'pengarang' => 'required',
        'tahun_terbit' => 'required',
        'penerbit' => 'required',
        'stok' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg|max:2048', // Validasi gambar
    ]);

    $buku = Buku::findOrFail($id);

    $buku->update([
        'judul' => $request->judul,
        'pengarang' => $request->pengarang,
        'tahun_terbit' => $request->tahun_terbit,
        'penerbit' => $request->penerbit,
        'stok' => $request->stok,
        'gambar' => $request->file('gambar') ? $request->file('gambar')->store('public/gambar_buku') : $buku->gambar,
    ]);

    return redirect()->route('buku.index');
}


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('buku.index');
    }
}
