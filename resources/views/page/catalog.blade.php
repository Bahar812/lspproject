@extends('layouts.app')

@section('content')
    <style>
        .catalog-hero {
            background: linear-gradient(135deg, #f7f1e3 0%, #e3f2f1 100%);
            border-radius: 16px;
        }
        .catalog-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .catalog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }
        .book-cover {
            height: 240px;
            object-fit: cover;
        }
        .catalog-badge {
            background: #1d3557;
        }
    </style>

    <div class="container py-4">
        <div class="catalog-hero p-4 p-md-5 mb-4">
            <div class="row align-items-center gy-3">
                <div class="col-lg-7">
                    <span class="badge catalog-badge mb-3">Perpustakaan Digital</span>
                    <h1 class="fw-bold mb-2">Katalog Buku</h1>
                    <p class="text-muted mb-0">Temukan buku favoritmu dan lihat koleksi terbaru dengan cepat.</p>
                </div>
                <div class="col-lg-5 text-lg-end">
                    <a href="{{ route('login') }}" class="btn btn-dark px-4">Login</a>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <form method="GET" action="{{ route('buku.katalog') }}">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" name="query" placeholder="Cari judul atau pengarang..." value="{{ request()->query('query') }}">
                            <button class="btn btn-dark" type="submit">Cari</button>
                            <a href="{{ route('buku.katalog') }}" class="btn btn-outline-dark">Semua</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            @foreach ($buku as $b)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm catalog-card">
                        <img src="{{ asset('storage/'.$b->gambar) }}" class="card-img-top book-cover" alt="Gambar Buku">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $b->judul }}</h5>
                            <p class="text-muted mb-3">{{ $b->pengarang }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="small text-muted">{{ $b->penerbit }}</span>
                                <span class="badge bg-success">Stok {{ $b->stok }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
