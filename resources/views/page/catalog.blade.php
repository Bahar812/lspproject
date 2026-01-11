@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-5">Katalog Buku</h1>

    <div class="container">
        <div class="row justify-content-end mb-4">
            <div class="col-md-2">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form method="GET" action="{{ route('buku.katalog') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Cari Buku..." value="{{ request()->query('query') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                       
                        <a href="{{ route('buku.katalog') }}" class="btn btn-secondary">All</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach ($buku as $b)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/'.$b->gambar) }}" class="card-img-top" alt="Gambar Buku" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $b->judul }}</h5>
                            <p class="card-text">{{ $b->pengarang }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
