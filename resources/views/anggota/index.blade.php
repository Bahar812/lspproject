@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

         <div class="container-fluid p-4" style="margin-left: 5px;">
            <h1>Daftar Anggota</h1>
            <a href="{{ route('anggota.create') }}" class="btn btn-success mb-3">Tambah Anggota</a>
            
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Tanggal Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggota as $a)
                        <tr>
                            <td>{{ $a->id }}</td>
                            <td>{{ $a->nama }}</td>
                            <td>{{ $a->no_hp }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->alamat }}</td>
                            <td>{{ $a->tgl_bergabung }}</td>
                            <td>
                                <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" style="display:inline;">
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
