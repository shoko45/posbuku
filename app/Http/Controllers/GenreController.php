<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    // Menampilkan daftar genre
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index', compact('genres'));
    }

    // Menampilkan form tambah genre
    public function create()
    {
        return view('genre.create');
    }

    // Menyimpan genre baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genre',
        ]);

        // Simpan genre baru
        Genre::create([
            'nama_genre' => $request->nama_genre,
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre berhasil ditambahkan.');
    }

    // Menampilkan form edit genre
    public function edit(Genre $genre)
    {
        return view('genre.edit', compact('genre'));
    }

    // Mengupdate data genre
    public function update(Request $request, Genre $genre)
    {
        // Validasi data
        $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genre,nama_genre,' . $genre->id,
        ]);

        // Update genre
        $genre->update([
            'nama_genre' => $request->nama_genre,
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre berhasil diperbarui.');
    }

    // Menghapus genre
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genre.index')->with('success', 'Genre berhasil dihapus.');
    }
}