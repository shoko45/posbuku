@extends('layout.app')

@section('title', 'Daftar Genre')

@section('content')
    <h1>Daftar Genre</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol untuk membuka modal tambah genre -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addGenreModal">
        Tambah Genre
    </button>

    <!-- Tabel Daftar Genre -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Genre</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $genre->nama_genre }}</td>
                    <td>
                        <!-- Tombol Edit Genre -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editGenreModal" data-id="{{ $genre->id }}"
                            data-nama_genre="{{ $genre->nama_genre }}">
                            Edit
                        </button>

                        <!-- Form hapus genre -->
                        <form action="{{ route('genre.destroy', $genre->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus genre ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Tambah Genre -->
    <div class="modal fade" id="addGenreModal" tabindex="-1" aria-labelledby="addGenreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('genre.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGenreModalLabel">Tambah Genre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_genre" class="form-label">Nama Genre</label>
                            <input type="text" class="form-control" id="nama_genre" name="nama_genre" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Genre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Genre -->
    <div class="modal fade" id="editGenreModal" tabindex="-1" aria-labelledby="editGenreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="editGenreForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGenreModalLabel">Edit Genre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_nama_genre" class="form-label">Nama Genre</label>
                            <input type="text" class="form-control" id="edit_nama_genre" name="nama_genre" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Genre</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Menangkap data dari tombol edit dan memasukkan ke modal
        $('#editGenreModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // tombol yang diklik
            var id = button.data('id');
            var nama_genre = button.data('nama_genre');

            var modal = $(this);
            modal.find('#edit_nama_genre').val(nama_genre);
            modal.find('#editGenreForm').attr('action', '/genre/' + id); // set action dinamis
        });
    </script>
@endsection
