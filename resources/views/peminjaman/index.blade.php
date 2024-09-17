@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between mb-3">
    <a href="/peminjaman/create" class="btn btn-primary">+ Tambah Data Peminjaman</a>
    <a href="/sesi/logout" class="btn btn-secondary">Logout</a>
</div>

<div>
    @if (Session('pesan'))
    <div class="alert alert-success" role="alert">{{ Session('pesan') }}</div>
    @endif
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Peminjaman</th>
            <th>Nama Pengguna</th>
            <th>Judul Buku</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status Peminjaman</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peminjaman as $item)
            <tr>
                <td>{{ $item->id_peminjaman }}</td>
                <td>{{ $item->user->username }}</td> 
                <td>{{ $item->buku->judul }}</td> 
                <td>{{ $item->tanggal_peminjaman}}</td> 
                <td>{{ $item->tanggal_pengembalian}}</td>
                <td>{{ $item->status_peminjaman }}</td>
                <td>
                    @if ($item->status_peminjaman == 'dipinjam')
                    <!-- Tampilkan tombol edit jika status peminjaman masih 'Dipinjam' -->
                    <a href="{{ route('peminjaman.edit', $item->id_peminjaman) }}" class="btn btn-primary btn-sm">Edit</a>
                @else
                    <span></span>
                @endif
                <form class="d-inline" action="{{ '/peminjaman/'.$item->id_peminjaman }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('DELETE')
                    @if ($item->status_peminjaman == 'dipinjam')
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>                        
                    @endif
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="/" class="btn btn-primary">>> kembali</a>
@endsection



