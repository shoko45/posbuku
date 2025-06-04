@extends('layout.app')

@section('title', 'Struk Transaksi')

@section('content')
    <style>
        .receipt {
            max-width: 300px;
            margin: 0 auto;
            padding: 15px;
            font-family: 'Courier New', Courier, monospace;
            background: #fff;
            border: 1px solid #000;
        }

        .receipt h2,
        .receipt p {
            text-align: center;
            margin: 0;
        }

        .receipt .items {
            margin-top: 10px;
        }

        .receipt .items table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt .items th,
        .receipt .items td {
            font-size: 14px;
            padding: 2px 0;
        }

        .receipt .total {
            margin-top: 10px;
            text-align: right;
            font-weight: bold;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }

            .receipt,
            .receipt * {
                visibility: visible !important;
            }

            .receipt {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                max-width: none;
                padding: 0;
                margin: 0;
                border: none;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

    <div class="receipt">
        <h2>TOKO BUKU MAKMUR</h2>
        <p>Jl. Literasi No. 42</p>
        <hr>
        <p><strong>Pembeli:</strong> {{ $transaksi->pembeli->nama_pembeli }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal }}</p>

        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Jml</th>
                        <th>Subttl</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detailTransaksi as $detail)
                        <tr>
                            <td>{{ $detail->buku->judul_buku }}</td>
                            <td>{{ $detail->jumlah_beli }}</td>
                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <hr>
        <p class="total">Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
        <hr>
        <p style="text-align: center">Terima kasih telah berbelanja!</p>
    </div>

    <div class="text-center mt-3 no-print">
        <button onclick="window.print()" class="btn btn-primary">Cetak Struk</button>
    </div>
@endsection
