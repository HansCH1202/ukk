@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
    <table class="table table-striped">
        <thead>
            @if (isset($results))
                <!-- Header tabel untuk hasil pencarian buku -->
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            @elseif(isset($users))
                <!-- Header tabel untuk hasil pencarian pengguna -->
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @if (isset($results))
                @foreach ($results as $result)
                    <!-- Isi tabel untuk hasil pencarian buku -->
                    <tr>
                        <th scope="row">{{ $result->id }}</th>
                        <td>{{ $result->title }}</td>
                        <td>{{ $result->author }}</td>
                        <td>{{ $result->publisher }}</td>
                        <td>{{ $result->year }}</td>
                        <td>{{ $result->isbn }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $result->cover) }}" alt="{{ $result->title }}" width="100px" />
                        </td>
                        <td>{{ $result->description }}</td>
                        <td>{{ $result->category }}</td>
                        <td nowrap>
                            <a href="{{ route('buku.edit', $result->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('buku.destroy', $result->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @elseif(isset($users))
                @foreach ($users as $user)
                    <!-- Isi tabel untuk hasil pencarian pengguna -->
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td nowrap>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
