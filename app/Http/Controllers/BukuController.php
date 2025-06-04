<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function index()
    {
        $genres = Genre::all();
        $bukus = Buku::with('genre')->get();
        return view('buku.index', compact('bukus', 'genres'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $genres = Genre::all();
        return view('buku.create', compact('genres'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'release_date' => 'required|date',
            'id_genre' => 'required|exists:genre,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Simpan file gambar
        $imagePath = $request->file('image')->store('images/buku', 'public');

        // Simpan buku baru
        Buku::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'image' => $imagePath,
            'release_date' => $request->release_date,
            'id_genre' => $request->id_genre,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    public function edit(Buku $buku)
    {
        $genres = Genre::all();
        return view('buku.edit', compact('buku', 'genres'));
    }

    // Mengupdate data buku
    public function update(Request $request, Buku $buku)
    {
        // Validasi data
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'release_date' => 'required|date',
            'id_genre' => 'required|exists:genre,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        // Update gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/buku', 'public');
            $buku->update([
                'image' => $imagePath,
            ]);
        }

        // Update buku
        $buku->update([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'release_date' => $request->release_date,
            'id_genre' => $request->id_genre,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}