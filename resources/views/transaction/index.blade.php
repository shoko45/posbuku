@extends('layout.app')

@section('title', 'Daftar Transaksi')

@section('content')
    <h1>Daftar Transaksi</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pembeli</th>
                <th>Buku</th>
                <th>Jumlah Beli</th>
                <th>Subtotal</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                @foreach($transaksi->detailTransaksi as $detail)
                    <tr>
                        <td>{{ $transaksi->pembeli->nama_pembeli }}</td>
                        <td>{{ $detail->buku->judul_buku }}</td>
                        <td>{{ $detail->jumlah_beli }}</td>
                        <td>{{ $detail->subtotal }}</td>
                        <td>{{ $transaksi->total_harga }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>
                            <!-- Link untuk melihat struk transaksi -->
                            <a href="{{ route('transaksi.struk', $transaksi->id) }}" class="btn btn-info">Lihat Struk</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@endsection
