@extends('layout.app')

@section('title', 'Tambah Transaksi')

@section('content')
    <h1>Tambah Transaksi</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
            <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak Pembeli</label>
            <input type="text" class="form-control" id="kontak" name="kontak">
        </div>

        <div class="mb-3" id="buku-container">
            <label for="buku" class="form-label">Buku</label>
            <div id="buku-list">
                <div class="row mb-3" id="buku-row-0">
                    <div class="col-md-5">
                        <select class="form-control" name="buku[0][id_buku]" required>
                            @foreach ($bukus as $buku)
                                <option value="{{ $buku->id }}" data-harga="{{ $buku->harga }}">{{ $buku->judul_buku }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="buku[0][jumlah_beli]" required min="1"
                            placeholder="Jumlah" oninput="updateTotalHarga(0)">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="buku[0][total_harga]" required readonly
                            placeholder="Total Harga">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-buku" onclick="removeBuku(0)">Hapus</button>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-success" id="add-buku">Tambah Buku</button>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>

    <script>
        let bukuCount = 1; // Start from the second buku row as we have one row already in HTML

        // Add a new buku row
        document.getElementById('add-buku').addEventListener('click', function() {
            const newBukuRow = `
                <div class="row mb-3" id="buku-row-${bukuCount}">
                    <div class="col-md-5">
                        <select class="form-control" name="buku[${bukuCount}][id_buku]" required>
                            @foreach ($bukus as $buku)
                                <option value="{{ $buku->id }}" data-harga="{{ $buku->harga }}">{{ $buku->judul_buku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="buku[${bukuCount}][jumlah_beli]" required min="1" placeholder="Jumlah" oninput="updateTotalHarga(${bukuCount})">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="buku[${bukuCount}][total_harga]" required readonly placeholder="Total Harga">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-buku" onclick="removeBuku(${bukuCount})">Hapus</button>
                    </div>
                </div>
            `;

            document.getElementById('buku-list').insertAdjacentHTML('beforeend', newBukuRow);
            bukuCount++;
        });

        // Remove a buku row
        function removeBuku(rowId) {
            document.getElementById(`buku-row-${rowId}`).remove();
            bukuCount--;
        }

        // Update total price for a book
        function updateTotalHarga(rowId) {
            const jumlahBeli = document.querySelector(`input[name="buku[${rowId}][jumlah_beli]"]`).value;
            const selectedBukuId = document.querySelector(`select[name="buku[${rowId}][id_buku]"]`).value;

            // Get the harga (price) from the selected book's option element
            const selectedOption = document.querySelector(`select[name="buku[${rowId}][id_buku]"]`).selectedOptions[0];
            const bukuHarga = selectedOption.getAttribute('data-harga');

            // Calculate total price
            const totalHarga = jumlahBeli * bukuHarga;
            document.querySelector(`input[name="buku[${rowId}][total_harga]"]`).value = totalHarga;
        }
    </script>
@endsection
