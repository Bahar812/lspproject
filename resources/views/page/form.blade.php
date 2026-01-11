@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ isset($buku) ? 'Edit Buku' : 'Tambah Buku' }}</h1>

                <form action="{{ isset($buku) ? route('buku.update', $buku->id) : route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($buku))
                        @method('PUT') 
                    @endif

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $buku->judul ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $buku->stok ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Buku</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">

                        @if(isset($buku) && $buku->gambar)
                            
                            <img src="{{ Storage::url($buku->gambar) }}" alt="Gambar Buku" width="150" class="mt-2">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
