@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4 page-shell">
            <div class="page-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Edit Peminjaman</h1>
                        <p class="mb-0 text-muted">Perbarui detail peminjaman sesuai kebutuhan.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-dark">Kembali</a>
                    </div>
                </div>
            </div>

            <div class="card content-card">
                <div class="card-body">
                    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="id_anggota" class="form-label">Anggota</label>
                                <select name="id_anggota" id="id_anggota" class="form-control">
                                    @foreach ($anggota as $a)
                                        <option value="{{ $a->id }}" {{ $peminjaman->id_anggota == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="id_staff" class="form-label">Staff</label>
                                <select name="id_staff" id="id_staff" class="form-control">
                                    @foreach ($staff as $s)
                                        <option value="{{ $s->id }}" {{ $peminjaman->id_staff == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_pinjam" class="form-label">Tanggal Pinjam</label>
                                <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="{{ $peminjaman->tgl_pinjam }}">
                            </div>
                            <div class="col-md-6">
                                <label for="tgl_kembali" class="form-label">Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="{{ $peminjaman->tgl_kembali }}">
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">Update</button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
