

@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
<a href="/ulasan/create" class="btn btn-primary">+ Tambah Ulasan</a>
<a href="/sesi/logout" class="btn btn-secondary">Logout</a>


</div>

<div>
    @if (Session('pesan'))
    <div class="alert alert-success" role="alert">{{Session('pesan')}}</div>
    @endif
</div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Buku</th>
                <th>Ulasan</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ulasan as $item)
                <tr>
                    <th>{{$loop->iteration}}</th>
                    <td>{{$item->user->username}}</td>
                    <td>{{$item->buku->judul}}</td>
                    <td>{{$item->ulasan}}</td>
                    <td>{{$item->rating}}</td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="/ulasan/{{$item->id_ulasan}}/edit">Edit</a>
                        <form class="d-inline" action="{{ '/ulasan/'.$item->id_ulasan }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/" class="btn btn-primary">>>kembali</a>
@endsection