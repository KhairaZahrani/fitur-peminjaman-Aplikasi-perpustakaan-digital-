@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3>Tambah Ulasan Baru</h3>
        </div>
        <div class="card-body">
            <form action="/ulasan" method="POST">
                @csrf
                <!-- Pilih Buku -->
                <div class="mb-3">
                    <label for="id_buku" class="form-label"><strong>Buku</strong></label>
                    <select name="id_buku" id="id_buku" class="form-select @error('id_buku') is-invalid @enderror">
                        <option value="">Pilih Buku</option>
                        @foreach ($buku as $b)
                            <option value="{{ $b->id_buku }}" {{ old('id_buku') == $b->id_buku ? 'selected' : '' }}>
                                {{ $b->judul }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_buku')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Nama User (Tersembunyi) -->
                @if(auth()->check())
                    <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label for="id_user" class="form-label"><strong>Nama User</strong></label>
                        <input type="text" class="form-control" value="{{ auth()->user()->username }}" readonly>
                        <input type="hidden" id="id_user" name="id_user" class="form-control" value="{{ auth()->user()->id_user }}" readonly>
                    </div>
                @else
                    <!-- Atau tampilkan pesan error jika tidak ada pengguna yang login -->
                    <p>Anda harus login untuk menambahkan ulasan.</p>
                @endif

                <!-- Ulasan -->
                <div class="mb-3">
                    <label for="ulasan" class="form-label"><strong>Ulasan</strong></label>
                    <textarea name="ulasan" id="ulasan" rows="4" class="form-control @error('ulasan') is-invalid @enderror">{{old('ulasan')}}</textarea>
                    @error('ulasan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Rating -->
                <div class="mb-3">
                    <label for="rating" class="form-label"><strong>Rating</strong></label>
                    <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    @error('rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                

                <button type="submit" class="btn btn-primary">Simpan Ulasan</button>
                <a href="/ulasan" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
