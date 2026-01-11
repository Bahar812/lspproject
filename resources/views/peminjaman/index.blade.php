@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

      <div class="container-fluid p-4" style="margin-left: 5px;">
            <h1>Daftar Peminjaman</h1>
            <a href="{{ route('peminjaman.create') }}" class="btn btn-success mb-3">Tambah Peminjaman</a>
            
             <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Peminjaman</th>
                        <th>Nama Anggota</th>
                        <th>Buku yang Dipinjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->anggota->nama }}</td>
                            <td>
                                @foreach ($p->itemPeminjaman as $item)
                                    <p>{{ $item->buku->judul }}</p>
                                @endforeach
                            </td>
                            <td>{{ $p->tgl_pinjam }}</td>
                            <td>{{ $p->tgl_kembali }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
