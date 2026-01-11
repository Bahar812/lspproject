@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            <h1>Edit Staff</h1>
            <form action="{{ route('staff.update', $staff->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $staff->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}" required>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $staff->no_hp }}" required>
                </div>
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" name="posisi" id="posisi" class="form-control" value="{{ $staff->posisi }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
