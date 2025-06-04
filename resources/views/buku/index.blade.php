@extends('layout.app')

@section('title', 'Daftar Buku')

@section('content')
    <h1>Daftar Buku</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tombol untuk ke halaman tambah buku -->
    <a href="{{ route('buku.create') }}" class="btn btn-primary mb-3">
        Tambah Buku
    </a>

    <!-- Tabel Daftar Buku -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Genre</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $buku)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $buku->image) }}" 
                             alt="{{ $buku->judul_buku }}" 
                             style="width: 80px; height: auto;">
                    </td>
                    <td>{{ $buku->judul_buku }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->genre->nama_genre }}</td>
                    <td>Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>{{ $buku->stok }}</td>
                    <td>
                        <!-- Tombol Edit ke halaman edit -->
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Form hapus buku -->
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
