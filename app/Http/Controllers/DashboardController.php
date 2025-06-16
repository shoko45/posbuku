<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        // Total buku
        $totalBooks = Buku::count();

        // Total transaksi
        $totalTransactions = Transaksi::count();

        // Total penjualan
        $totalSales = Transaksi::sum('total_harga'); // pastikan nama field di tabel benar

        // Transaksi terbaru
        $transactions = Transaksi::with('pembeli')->latest()->take(5)->get();

        return view('dashboard', compact('totalBooks', 'totalTransactions', 'totalSales', 'transactions'));
    }
}
