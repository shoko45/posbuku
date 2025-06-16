@extends('layout.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Dashboard POS Buku</h1>

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Buku</h2>
                <p class="text-3xl font-bold">{{ $totalBooks }}</p>
            </div>
            <div class="bg-green-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Transaksi</h2>
                <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
            </div>
            <div class="bg-yellow-100 p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Penjualan</h2>
                <p class="text-3xl font-bold">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-white rounded shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Transaksi Terbaru</h2>
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Pembeli</th>
                        <th class="px-4 py-2 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trx)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $trx->id }}</td>
                            <td class="px-4 py-2">{{ $trx->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $trx->pembeli->nama ?? 'Umum' }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
