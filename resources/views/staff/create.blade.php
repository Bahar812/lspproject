@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4 page-shell">
            <div class="page-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Tambah Staff</h1>
                        <p class="mb-0 text-muted">Tambahkan data staff baru untuk operasional.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('staff.index') }}" class="btn btn-outline-dark">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card content-card">
                <div class="card-body">
                    <form action="{{ route('staff.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="posisi" class="form-label">Posisi</label>
                                <input type="text" name="posisi" id="posisi" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">Simpan</button>
                            <a href="{{ route('staff.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
