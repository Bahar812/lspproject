@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

         <div class="container-fluid p-4 page-shell">
            <div class="page-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Anggota</h1>
                        <p class="mb-0 text-muted">Kelola data anggota perpustakaan dengan cepat.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('anggota.create') }}" class="btn btn-dark px-4">Tambah Anggota</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <form method="GET" action="{{ route('anggota.index') }}" class="d-flex gap-2">
                            <input type="text" name="q" class="form-control" placeholder="Cari nama, email, atau nomor..." value="{{ $query ?? '' }}">
                            <button type="submit" class="btn btn-dark">Cari</button>
                            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card content-card table-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Bergabung</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $a)
                                    <tr>
                                        <td>#{{ $a->id }}</td>
                                        <td class="fw-semibold">{{ $a->nama }}</td>
                                        <td>{{ $a->no_hp }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->alamat }}</td>
                                        <td>{{ $a->tgl_bergabung }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
