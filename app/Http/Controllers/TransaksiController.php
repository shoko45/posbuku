<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pembeli;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function create()
    {
        $bukus = Buku::all();
        return view('transaction.create', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'buku' => 'required|array',
            'buku.*.id_buku' => 'required|exists:buku,id',
            'buku.*.jumlah_beli' => 'required|integer|min:1',
            'buku.*.total_harga' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->buku as $item) {
                $buku = Buku::find($item['id_buku']);
                if (!$buku) {
                    return back()->withErrors("Buku dengan ID {$item['id_buku']} tidak ditemukan")->withInput();
                }
                if ($buku->stok < $item['jumlah_beli']) {
                    return back()->withErrors("Stok buku \"{$buku->judul_buku}\" tidak cukup! (stok tersedia: {$buku->stok})")->withInput();
                }
            }

            $pembeli = Pembeli::create([
                'nama_pembeli' => $request->nama_pembeli,
                'kontak' => $request->kontak,
            ]);

            $totalHarga = array_sum(array_column($request->buku, 'total_harga'));
            $transaksi = Transaksi::create([
                'id_pembeli' => $pembeli->id,
                'tanggal' => now(),
                'total_harga' => $totalHarga,
            ]);

            foreach ($request->buku as $item) {
                $buku = Buku::find($item['id_buku']);

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_buku' => $item['id_buku'],
                    'jumlah_beli' => $item['jumlah_beli'],
                    'subtotal' => $item['jumlah_beli'] * $buku->harga,
                ]);

                $buku->stok -= $item['jumlah_beli'];
                $buku->save();
            }

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage())->withInput();
        }
    }

    public function index()
    {
        $transaksis = Transaksi::with('pembeli', 'detailTransaksi.buku')->get();
        return view('transaction.index', compact('transaksis'));
    }

    public function viewStruk($id)
    {
        $transaksi = Transaksi::with('detailTransaksi', 'pembeli', 'detailTransaksi.buku')->findOrFail($id);
        return view('transaction.struk', compact('transaksi'));
    }

   public function cetakPdf($id)
{
    $transaksi = Transaksi::with(['pembeli', 'detailTransaksi.buku'])->findOrFail($id);

    $pdf = Pdf::loadView('transaction.struk_pdf', compact('transaksi'))
              ->setPaper([0, 0, 226.77, 600], 'portrait'); // ukuran thermal 80mm

              return $pdf->stream('struk-transaksi-' . $id . '.pdf');

}

}