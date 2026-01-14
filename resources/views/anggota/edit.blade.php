@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4 page-shell">
            <div class="page-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Edit Anggota</h1>
                        <p class="mb-0 text-muted">Perbarui data anggota sesuai kebutuhan.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('anggota.index') }}" class="btn btn-outline-dark">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card content-card">
                <div class="card-body">
                    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $anggota->nama }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $anggota->no_hp }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $anggota->email }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_bergabung" class="form-label">Tanggal Bergabung</label>
                                <input type="date" name="tgl_bergabung" id="tgl_bergabung" class="form-control" value="{{ $anggota->tgl_bergabung }}" required>
                            </div>
                            <div class="col-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ $anggota->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">Update</button>
                            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
