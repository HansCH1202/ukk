@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="Masukkan email pengguna" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                placeholder="Masukkan password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" placeholder="Konfirmasi password">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
    </form>
@endsection
