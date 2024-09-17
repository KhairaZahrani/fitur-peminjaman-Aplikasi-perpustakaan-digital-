@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <a href="/buku/create" class="btn btn-primary">+ Tambah Data Buku</a>
    <a href="/sesi/logout" class="btn btn-secondary">Logout</a>
</div>

<div>
    @if (Session('pesan'))
    <div class="alert alert-success" role="alert">{{ Session('pesan') }}</div>
    @endif
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Deskripsi</th>
            <th>Tahun Terbit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <td>{{ $item->kategori->kategori ?? 'Tidak Ada Kategori' }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->penulis }}</td>
                <td>{{ $item->penerbit }}</td>
                <td class="text-truncate" style="max-width: 150px;">
                    {{ $item->deskripsi }}
                </td>
                <td>{{ $item->tahun_terbit }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a class="btn btn-secondary btn-sm" href="/buku/{{ $item->id_buku }}">Detail</a>
                        <a class="btn btn-warning btn-sm" href="/buku/{{ $item->id_buku }}/edit">Edit</a>
                        <form class="d-inline" action="{{ '/buku/'.$item->id_buku }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="/" class="btn btn-primary">>> kembali</a>

@endsection

@section('styles')
<style>
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Pastikan tabel menggunakan layout yang tetap */
    table {
        table-layout: fixed;
        width: 100%;
    }

    td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
@endsection
