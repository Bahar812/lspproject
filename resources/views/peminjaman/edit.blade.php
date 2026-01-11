@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            <h1>Edit Peminjaman</h1>
            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="id_anggota">Anggota</label>
                    <select name="id_anggota" id="id_anggota" class="form-control">
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}" {{ $peminjaman->id_anggota == $a->id ? 'selected' : '' }}>{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_staff">Staff</label>
                    <select name="id_staff" id="id_staff" class="form-control">
                        @foreach ($staff as $s)
                            <option value="{{ $s->id }}" {{ $peminjaman->id_staff == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="{{ $peminjaman->tgl_pinjam }}">
                </div>
                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="{{ $peminjaman->tgl_kembali }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
