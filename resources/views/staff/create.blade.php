@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            <h1>Tambah Staff</h1>
            <form action="{{ route('staff.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" name="posisi" id="posisi" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
