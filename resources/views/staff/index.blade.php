@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

         <div class="container-fluid p-4 page-shell">
            <div class="page-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Staff</h1>
                        <p class="mb-0 text-muted">Kelola data staff dan akun pengguna.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('staff.create') }}" class="btn btn-dark px-4 me-2">Tambah Staff</a>
                        <a href="{{ route('user.create') }}" class="btn btn-outline-dark">Tambah User</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <form method="GET" action="{{ route('staff.index') }}" class="d-flex gap-2">
                            <input type="text" name="q" class="form-control" placeholder="Cari nama, email, atau posisi..." value="{{ $query ?? '' }}">
                            <button type="submit" class="btn btn-dark">Cari</button>
                            <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Posisi</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff as $s)
                                    <tr>
                                        <td>#{{ $s->id }}</td>
                                        <td class="fw-semibold">{{ $s->nama }}</td>
                                        <td>{{ $s->email }}</td>
                                        <td>{{ $s->no_hp }}</td>
                                        <td>{{ $s->posisi }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('staff.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('staff.destroy', $s->id) }}" method="POST" class="d-inline">
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
