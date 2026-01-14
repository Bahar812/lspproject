<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\ItemPeminjaman;
use App\Models\Anggota;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');
        $sort = $request->query('sort', 'id');
        $dir = $request->query('dir', 'desc');
        $dir = $dir === 'asc' ? 'asc' : 'desc';

        $filter = function ($q) use ($query) {
            $q->when($query, function ($sub) use ($query) {
                $sub->where('id', 'like', "%{$query}%")
                    ->orWhereHas('anggota', function ($rel) use ($query) {
                        $rel->where('nama', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%");
                    })
                    ->orWhereHas('staff', function ($rel) use ($query) {
                        $rel->where('nama', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%");
                    })
                    ->orWhereHas('itemPeminjaman.buku', function ($rel) use ($query) {
                        $rel->where('judul', 'like', "%{$query}%")
                            ->orWhere('pengarang', 'like', "%{$query}%");
                    });
            });
        };

        $applySort = function ($builder) use ($sort, $dir) {
            if ($sort === 'tgl_pinjam') {
                return $builder->orderBy('tgl_pinjam', $dir);
            }

            if ($sort === 'tgl_kembali') {
                return $builder->orderBy('tgl_kembali', $dir);
            }

            if ($sort === 'status') {
                $order = $dir === 'asc' ? 'asc' : 'desc';
                return $builder->orderByRaw(
                    "CASE
                        WHEN tgl_dikembalikan IS NOT NULL THEN 3
                        WHEN tgl_kembali < ? THEN 2
                        ELSE 1
                    END {$order}",
                    [Carbon::today()->toDateString()]
                );
            }

            return $builder->orderBy('id', 'desc');
        };

        $peminjaman = $applySort(
            Peminjaman::with('anggota', 'staff', 'itemPeminjaman.buku')
                ->where($filter)
        )->get();

        $peminjamanAktif = $applySort(
            Peminjaman::with('anggota', 'staff', 'itemPeminjaman.buku')
            ->whereNull('tgl_dikembalikan')
            ->where('tgl_kembali', '>=', Carbon::today())
            ->where($filter)
        )->get();

        $peminjamanJatuhTempo = $applySort(
            Peminjaman::with('anggota', 'staff', 'itemPeminjaman.buku')
            ->whereNull('tgl_dikembalikan')
            ->where('tgl_kembali', '<', Carbon::today())
            ->where($filter)
        )->get();

        return view('peminjaman.index', compact('peminjaman', 'peminjamanAktif', 'peminjamanJatuhTempo', 'query', 'sort', 'dir'));
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

    public function kembali($id)
    {
        $peminjaman = Peminjaman::with('itemPeminjaman.buku')->findOrFail($id);

        if ($peminjaman->tgl_dikembalikan) {
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman sudah dikembalikan.');
        }

        DB::transaction(function () use ($peminjaman) {
            foreach ($peminjaman->itemPeminjaman as $item) {
                if ($item->buku) {
                    $item->buku->increment('stok');
                }
            }

            $peminjaman->update([
                'tgl_dikembalikan' => now()->toDateString(),
            ]);
        });

        return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}
