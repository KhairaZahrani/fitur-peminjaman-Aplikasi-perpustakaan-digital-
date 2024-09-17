@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Peminjaman</h1>

    <form action="/peminjaman" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_user">Pengguna</label>
            <input type="text" class="form-control" value="{{ Auth::user()->username }}" disabled> 
            <input type="hidden" name="id_user" value="{{ Auth::user()->id_user }}">
        </div>

        <div class="form-group">
            <label for="id_buku">Buku</label>
            <select name="id_buku" id="id_buku" class="form-control" required>
                <option value="">Pilih Buku</option>
                @foreach ($buku as $b)
                    <option value="{{ $b->id_buku }}">{{ $b->judul }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
            <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status_peminjaman">Status Peminjaman</label>
            <select name="status_peminjaman" id="status_peminjaman" class="form-control" required>
                <option value="dipinjam">Dipinjam</option>
                <option value="dikembalikan">Dikembalikan</option>
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
