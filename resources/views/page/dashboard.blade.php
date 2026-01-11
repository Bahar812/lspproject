<!-- resources/views/page/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 5px;">
            <h1>Dashboard</h1>
            <a href="{{ route('buku.create') }}" class="btn btn-success mb-3">Tambah Buku</a>
            
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $b)
                        <tr>
                            <td>{{ $b->id }}</td>
                            <td>{{ $b->judul }}</td>
                            <td>{{ $b->pengarang }}</td>
                            <td>{{ $b->tahun_terbit }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>
                                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" style="display:inline;">
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
