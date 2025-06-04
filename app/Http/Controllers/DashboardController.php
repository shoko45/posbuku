<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $totalBooks = 120;
    $totalTransactions = 57;
    $totalSales = 2150000;

    $transactions = [
        ['id' => 'TRX001', 'date' => '2025-06-01', 'customer' => 'Budi', 'total' => 50000],
        ['id' => 'TRX002', 'date' => '2025-06-02', 'customer' => 'Sari', 'total' => 75000],
        ['id' => 'TRX003', 'date' => '2025-06-03', 'customer' => 'Agus', 'total' => 120000],
        ['id' => 'TRX004', 'date' => '2025-06-04', 'customer' => 'Dewi', 'total' => 90000],
        ['id' => 'TRX005', 'date' => '2025-06-04', 'customer' => 'Rudi', 'total' => 65000],
    ];

    return view('dashboard', compact('totalBooks', 'totalTransactions', 'totalSales', 'transactions'));
}

}
