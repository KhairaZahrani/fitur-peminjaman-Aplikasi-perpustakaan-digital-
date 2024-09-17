@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman->id_peminjaman) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Nama Pengguna</label>
            <input type="text" class="form-control" id="username" value="{{ $peminjaman->user->username }}" disabled>
        </div>

        <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
            <select name="id_buku" class="form-control" required>
                @foreach ($buku as $item)
                    <option value="{{ $item->id_buku }}" {{ $peminjaman->id_buku == $item->id_buku ? 'selected' : '' }}>
                        {{ $item->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $peminjaman->tanggal_peminjaman }}" disabled>
        </div>

        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" class="form-control" value="{{ $peminjaman->tanggal_pengembalian }}" required>
        </div>

        <div class="form-group">
            <label for="status_peminjaman">Status Peminjaman</label>
            <select name="status_peminjaman" class="form-control" required>
                <option value="dipinjam" {{ $peminjaman->status_peminjaman == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="dikembalikan" {{ $peminjaman->status_peminjaman == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
