@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('components.sidebar')

        <div class="container-fluid p-4" style="margin-left: 250px;">
            <h1>Tambah Peminjaman</h1>
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_anggota">Anggota</label>
                    <select name="id_anggota" id="id_anggota" class="form-control">
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}">{{ $a->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id_staff">Staff</label>
                    <select name="id_staff" id="id_staff" class="form-control">
                        @foreach ($staff as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="{{ $tgl_pinjam }}" readonly>
                </div>

                <div class="form-group">
                    <label for="tgl_kembali">Tanggal Kembali</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" value="{{ $tgl_kembali }}" readonly>
                </div>

                <div class="form-group">
                    <label for="buku_ids">Pilih Buku</label>
                    <select name="buku_ids[]" id="buku_ids" class="form-control" multiple>
                        @foreach ($buku as $b)
                            <option value="{{ $b->id }}">{{ $b->judul }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Pilih buku yang ingin dipinjam.</small>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#buku_ids').select2({
                placeholder: "Cari buku...",
                allowClear: true
            });
        });
    </script>
@endsection
