@extends('layouts.app')

@section('content')
    <style>
        .loan-wrap {
            background: #f5f6f8;
            min-height: 100vh;
        }
        .loan-hero {
            background: linear-gradient(120deg, #dbeafe 0%, #d1fae5 100%);
            border-radius: 18px;
        }
        .loan-card {
            border-radius: 16px;
            border: 0;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        }
        .badge-status {
            background: #0f172a;
        }
        .tab-pill .nav-link {
            border-radius: 999px;
            padding: 8px 16px;
        }
        .tab-pill .nav-link.active {
            background: #0f172a;
        }
    </style>
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4 loan-wrap">
            <div class="loan-hero p-4 p-md-5 mb-4">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">Peminjaman</h1>
                        <p class="mb-0 text-muted">Kelola transaksi peminjaman sekaligus melihat laporan aktif dan jatuh tempo.</p>
                    </div>
                    <div class="col-lg-5 text-lg-end">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-dark px-4">Tambah Peminjaman</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <form method="GET" action="{{ route('peminjaman.index') }}" class="d-flex gap-2">
                            <input type="text" name="q" class="form-control" placeholder="Cari anggota, staff, atau buku..." value="{{ $query ?? '' }}">
                            <input type="hidden" name="sort" value="{{ $sort ?? 'id' }}">
                            <input type="hidden" name="dir" value="{{ $dir ?? 'desc' }}">
                            <button type="submit" class="btn btn-dark">Cari</button>
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="card loan-card p-3">
                        <span class="text-muted small">Total Peminjaman</span>
                        <h4 class="fw-bold mb-0">{{ $peminjaman->count() }}</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card loan-card p-3">
                        <span class="text-muted small">Aktif</span>
                        <h4 class="fw-bold mb-0">{{ $peminjamanAktif->count() }}</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card loan-card p-3">
                        <span class="text-muted small">Jatuh Tempo</span>
                        <h4 class="fw-bold mb-0">{{ $peminjamanJatuhTempo->count() }}</h4>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card loan-card p-3">
                        <span class="text-muted small">Selesai</span>
                        <h4 class="fw-bold mb-0">{{ $peminjaman->whereNotNull('tgl_dikembalikan')->count() }}</h4>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills tab-pill mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="daftar-tab" data-bs-toggle="pill" data-bs-target="#daftar" type="button" role="tab">Daftar Peminjaman</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="laporan-tab" data-bs-toggle="pill" data-bs-target="#laporan" type="button" role="tab">Laporan</button>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
                    <div class="card loan-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Anggota</th>
                                            <th>Buku</th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span>Tanggal Pinjam</span>
                                                    @php
                                                        $pinjamDir = ($sort ?? '') === 'tgl_pinjam' && ($dir ?? '') === 'asc' ? 'desc' : 'asc';
                                                    @endphp
                                                    <a href="{{ route('peminjaman.index', ['q' => $query, 'sort' => 'tgl_pinjam', 'dir' => $pinjamDir]) }}" class="btn btn-sm btn-outline-secondary">Sort</a>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span>Tanggal Kembali</span>
                                                    @php
                                                        $kembaliDir = ($sort ?? '') === 'tgl_kembali' && ($dir ?? '') === 'asc' ? 'desc' : 'asc';
                                                    @endphp
                                                    <a href="{{ route('peminjaman.index', ['q' => $query, 'sort' => 'tgl_kembali', 'dir' => $kembaliDir]) }}" class="btn btn-sm btn-outline-secondary">Sort</a>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="d-flex align-items-center gap-2">
                                                    <span>Status</span>
                                                    @php
                                                        $statusDir = ($sort ?? '') === 'status' && ($dir ?? '') === 'asc' ? 'desc' : 'asc';
                                                    @endphp
                                                    <a href="{{ route('peminjaman.index', ['q' => $query, 'sort' => 'status', 'dir' => $statusDir]) }}" class="btn btn-sm btn-outline-secondary">Sort</a>
                                                </div>
                                            </th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $p)
                                            <tr>
                                                <td>#{{ $p->id }}</td>
                                                <td class="fw-semibold">{{ $p->anggota->nama }}</td>
                                                <td>
                                                    @foreach ($p->itemPeminjaman as $item)
                                                        <span class="badge bg-light text-dark border mb-1">{{ $item->buku->judul }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $p->tgl_pinjam }}</td>
                                                <td>{{ $p->tgl_kembali }}</td>
                                                <td>
                                                    @if ($p->tgl_dikembalikan)
                                                        <span class="badge bg-success">Dikembalikan</span>
                                                        <div class="text-muted small">{{ $p->tgl_dikembalikan }}</div>
                                                    @elseif ($p->tgl_kembali < now()->toDateString())
                                                        <span class="badge bg-danger">Terlambat</span>
                                                    @else
                                                        <span class="badge badge-status">Dipinjam</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if (!$p->tgl_dikembalikan)
                                                        <form action="{{ route('peminjaman.kembali', $p->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-primary">Kembalikan</button>
                                                        </form>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="laporan" role="tabpanel" aria-labelledby="laporan-tab">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="card loan-card h-100">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-3">Peminjaman Aktif</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Buku</th>
                                                    <th>Kembali</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($peminjamanAktif as $p)
                                                    <tr>
                                                        <td>#{{ $p->id }}</td>
                                                        <td>{{ $p->anggota->nama }}</td>
                                                        <td>
                                                            @foreach ($p->itemPeminjaman as $item)
                                                                <div class="small text-muted">{{ $item->buku->judul }}</div>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $p->tgl_kembali }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted">Tidak ada peminjaman aktif.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card loan-card h-100">
                                <div class="card-body">
                                    <h5 class="fw-semibold mb-3">Peminjaman Jatuh Tempo</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Buku</th>
                                                    <th>Kembali</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($peminjamanJatuhTempo as $p)
                                                    <tr>
                                                        <td>#{{ $p->id }}</td>
                                                        <td>{{ $p->anggota->nama }}</td>
                                                        <td>
                                                            @foreach ($p->itemPeminjaman as $item)
                                                                <div class="small text-muted">{{ $item->buku->judul }}</div>
                                                            @endforeach
                                                        </td>
                                                        <td><span class="badge bg-danger">{{ $p->tgl_kembali }}</span></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted">Tidak ada peminjaman jatuh tempo.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
