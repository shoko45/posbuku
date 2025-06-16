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
            <th>SubTotal</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $transaksi)
            @foreach($transaksi->detailTransaksi as $loopIndex => $detail)
                <tr>
                    @if ($loop->first)
                        <td rowspan="{{ $transaksi->detailTransaksi->count() }}">{{ $transaksi->pembeli->nama_pembeli }}</td>
                    @endif

                    <td>{{ $detail->buku->judul_buku }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td>

                    @if ($loop->first)
                        <td rowspan="{{ $transaksi->detailTransaksi->count() }}">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td rowspan="{{ $transaksi->detailTransaksi->count() }}">{{ $transaksi->tanggal }}</td>
                        <td rowspan="{{ $transaksi->detailTransaksi->count() }}">
                    <div class="d-flex gap-2">
                        <a href="{{ route('transaksi.struk', $transaksi->id) }}" class="btn btn-info btn-sm">Lihat Struk</a>
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>

                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
