@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            <h1>Edit Anggota</h1>
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $anggota->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $anggota->no_hp }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $anggota->email }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" required>{{ $anggota->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="tgl_bergabung">Tanggal Bergabung</label>
                    <input type="date" name="tgl_bergabung" id="tgl_bergabung" class="form-control" value="{{ $anggota->tgl_bergabung }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
