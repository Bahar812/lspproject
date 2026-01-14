<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        $anggota = Anggota::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('no_hp', 'like', "%{$query}%")
                    ->orWhere('alamat', 'like', "%{$query}%");
            })
            ->get();

        return view('anggota.index', compact('anggota', 'query'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:anggota,email',
            'alamat' => 'required|string',
            'tgl_bergabung' => 'required|date',
        ]);

        Anggota::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_bergabung' => $request->tgl_bergabung,
        ]);

        return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:anggota,email,' . $id,
            'alamat' => 'required|string',
            'tgl_bergabung' => 'required|date',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_bergabung' => $request->tgl_bergabung,
        ]);

        return redirect()->route('anggota.index');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index');
    }
}
