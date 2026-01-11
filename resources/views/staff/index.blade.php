@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

         <div class="container-fluid p-4" style="margin-left: 5px;">
            <h1>Daftar Staff</h1>
            
            <a href="{{ route('staff.create') }}" class="btn btn-success mb-3">Tambah Staff</a>

            <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah User</a>

            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $s)
                        <tr>
                            <td>{{ $s->id }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->no_hp }}</td>
                            <td>{{ $s->posisi }}</td>
                            <td>
                                <a href="{{ route('staff.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('staff.destroy', $s->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
