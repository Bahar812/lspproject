<!-- resources/views/page/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
    <style>
        .dashboard-wrap {
            background: #f5f6f8;
            min-height: 100vh;
        }
        .dashboard-hero {
            background: linear-gradient(120deg, #f9dcc4 0%, #cfe8fc 100%);
            border-radius: 18px;
        }
        .stat-card {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }
        .stat-label {
            letter-spacing: 0.8px;
            text-transform: uppercase;
            font-size: 0.72rem;
        }
        .table-card {
            border-radius: 16px;
            border: 0;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }
        .book-thumb {
            width: 56px;
            height: 72px;
            object-fit: cover;
            border-radius: 10px;
        }
        .book-placeholder {
            width: 56px;
            height: 72px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5f5);
        }
        .action-btn {
            border-radius: 10px;
        }
    </style>
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4 dashboard-wrap">
            @if (($userRole ?? 'admin') === 'anggota')
                <div class="dashboard-hero p-4 p-md-5 mb-4">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-7">
                            <h1 class="fw-bold mb-2">Dashboard Anggota</h1>
                            <p class="mb-0 text-muted">Lihat daftar buku yang sedang dipinjam beserta tanggal kembali.</p>
                        </div>
                        <div class="col-lg-5 text-lg-end">
                            <span class="badge bg-dark px-3 py-2">{{ $anggota?->nama ?? 'Anggota' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card table-card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-semibold">Peminjaman Saya</h5>
                            <span class="text-muted small">Menampilkan riwayat peminjaman terakhir</span>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjamanAnggota ?? collect() as $p)
                                        <tr>
                                            <td>#{{ $p->id }}</td>
                                            <td>
                                                @foreach ($p->itemPeminjaman as $item)
                                                    <div class="small text-muted">{{ $item->buku->judul }}</div>
                                                @endforeach
                                            </td>
                                            <td>{{ $p->tgl_pinjam }}</td>
                                            <td>{{ $p->tgl_kembali }}</td>
                                            <td>
                                                @if ($p->tgl_dikembalikan)
                                                    <span class="badge bg-success">Dikembalikan</span>
                                                @else
                                                    <span class="badge bg-dark">Dipinjam</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada peminjaman.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="dashboard-hero p-4 p-md-5 mb-4">
                    <div class="row align-items-center gy-3">
                        <div class="col-lg-7">
                            <h1 class="fw-bold mb-2">Dashboard</h1>
                            <p class="mb-0 text-muted">Pantau koleksi, anggota, dan peminjaman terbaru di satu tempat.</p>
                        </div>
                        <div class="col-lg-5 text-lg-end">
                            <a href="{{ route('buku.create') }}" class="btn btn-dark px-4 action-btn">Tambah Buku</a>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6 col-lg-3">
                        <div class="card stat-card p-3">
                            <span class="stat-label text-muted">Total Buku</span>
                            <div class="d-flex align-items-end gap-2">
                                <h3 class="fw-bold mb-0">{{ $totalBuku }}</h3>
                                <span class="text-muted">judul</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card stat-card p-3">
                            <span class="stat-label text-muted">Total Stok</span>
                            <div class="d-flex align-items-end gap-2">
                                <h3 class="fw-bold mb-0">{{ $totalStok }}</h3>
                                <span class="text-muted">buku</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card stat-card p-3">
                            <span class="stat-label text-muted">Anggota</span>
                            <div class="d-flex align-items-end gap-2">
                                <h3 class="fw-bold mb-0">{{ $totalAnggota }}</h3>
                                <span class="text-muted">orang</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="card stat-card p-3">
                            <span class="stat-label text-muted">Peminjaman Aktif</span>
                            <div class="d-flex align-items-end gap-2">
                                <h3 class="fw-bold mb-0">{{ $peminjamanAktif }}</h3>
                                <span class="text-muted">transaksi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card table-card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <h5 class="mb-0 fw-semibold">Daftar Buku</h5>
                                <span class="text-muted small">Terbaru ditampilkan di bawah</span>
                            </div>
                            <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2">
                                <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari buku..." value="{{ $query ?? '' }}">
                                <button type="submit" class="btn btn-dark btn-sm">Cari</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Cover</th>
                                        <th>Judul</th>
                                        <th>Pengarang</th>
                                        <th>Tahun</th>
                                        <th>Stok</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $b)
                                        <tr>
                                            <td>
                                                @if ($b->gambar)
                                                    <img src="{{ asset('storage/'.$b->gambar) }}" alt="Cover Buku" class="book-thumb">
                                                @else
                                                    <div class="book-placeholder"></div>
                                                @endif
                                            </td>
                                            <td class="fw-semibold">{{ $b->judul }}</td>
                                            <td class="text-muted">{{ $b->pengarang }}</td>
                                            <td>{{ $b->tahun_terbit }}</td>
                                            <td><span class="badge bg-success">Stok {{ $b->stok }}</span></td>
                                            <td class="text-end">
                                                <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning btn-sm action-btn">Edit</a>
                                                <form action="{{ route('buku.destroy', $b->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm action-btn">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
