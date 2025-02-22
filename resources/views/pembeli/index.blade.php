@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><b>Form Pembelian Menu</b></div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pembeli.store') }}" method="POST" id="form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pembeli">Nama Pembeli :</label>
                                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_menu">Pilih Menu:</label>
                                    <select name="id_menu" id="id_menu" class="form-control" required onchange="updateHarga()">
                                        <option value="">-- Pilih Menu --</option>
                                        @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}" data-harga="{{ $menu->harga }}" data-stok="{{ $menu->stok }}">
                                                {{ $menu->nama_menu }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Harga Menu :</label>
                                    <input type="number" name="harga" id="harga" class="form-control" required readonly>
                                </div>
                                </div>

                                <script>
                                function updateHarga() {
                                    var menuSelect = document.getElementById('id_menu');
                                    var hargaInput = document.getElementById('harga');
                                    var stokInput = document.getElementById('stok');
                                    var jumlahInput = document.getElementById('jumlah');
                                    var totalHargaInput = document.getElementById('total_harga');
                                    var selectedOption = menuSelect.options[menuSelect.selectedIndex];

                                    if (selectedOption.value !== "") {
                                        var harga = selectedOption.getAttribute('data-harga');
                                        var stok = selectedOption.getAttribute('data-stok');

                                        hargaInput.value = harga;
                                        stokInput.value = stok;

                                        
                                        jumlahInput.addEventListener('input', function() {
                                            var jumlah = parseInt(jumlahInput.value) || 0;
                                            if (jumlah > parseInt(stok)) {
                                                Swal.fire({
                                                    title: 'Tidak Bisa',
                                                    text: 'Stok tidak mencukupi!',
                                                    icon: 'warning',
                                                    confirmButtonText: 'OK'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        jumlahInput.value = stok;
                                                        jumlah = stok;
                                                    }
                                                });
                                            }
                                            totalHargaInput.value = jumlah * harga;
                                        });
                                    } else {
                                        hargaInput.value = "";
                                        stokInput.value = "";
                                        totalHargaInput.value = "";
                                    }
                                }

                                
                                document.getElementById('form').addEventListener('submit', function(event) {
                                    var jumlahInput = document.getElementById('jumlah');
                                    var stokInput = document.getElementById('stok');
                                    var jumlah = parseInt(jumlahInput.value) || 0;
                                    var stok = parseInt(stokInput.value) || 0;

                                    
                                    if (stok === 0 || jumlah > stok) {
                                        event.preventDefault(); 
                                        Swal.fire({
                                            title: 'Pembelian Gagal',
                                            text: stok === 0 ? 'Stok tidak tersedia!' : 'Jumlah pembelian melebihi stok yang tersedia.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                });
                            </script>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stok">Stok :</label>
                                    <input type="number" name="stok" id="stok" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Pembelian :</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" required >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_harga">Total Harga :</label>
                                    <input type="number" name="total_harga" id="total_harga" class="form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="waktu_membeli">Waktu Membeli:</label>
                                    <input type="datetime-local" name="waktu_membeli" id="waktu_membeli" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi_pembeli">Deskripsi Pembelian:</label>
                                    <textarea name="deskripsi_pembeli" id="deskripsi_pembeli" class="form-control" rows="3" placeholder="Masukkan deskripsi pembelian" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="submitBtn">Lakukan Pembelian</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header"><b>Daftar Pembelian</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                    <form id="deleteAllForm" action="{{ route('pembeli.deleteMultiple') }}" method="POST">
                            @csrf
                            @method('DELETE')
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Nama Pembeli</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Deskripsi Pembelian</th>
                                    <th>Waktu Membeli</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pembeli as $item)
                                    <tr>
                                        <td><input type="checkbox" name="idsss[]" value="{{ $item->id }}" class="checkbox"></td>
                                        <td>{{ $item->nama_pembeli }}</td>
                                        <td>{{ $item->menu->nama_menu }}</td>
                                        <td>Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->deskripsi_pembeli }}</td>
                                        <td>{{ $item->waktu_membeli }}</td>
                                        <td>
                                            <a href="{{ route('pembeli.show', $item->id) }}" class="btn btn-info">Show</a>
                                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $item->id }}">Delete</button>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('pembeli.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger" id="deleteAllBtn">Delete All</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        Swal.fire({
            title: 'Sukses!',
            text: 'Pembelian Berhasil!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('pembeliForm').submit();
            }
        });
    });

    document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let itemId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + itemId).submit();
                    }
                });
            });
        });

    document.getElementById('deleteAllBtn').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('.checkbox:checked');
        if (checkboxes.length === 0) {
            Swal.fire('Pilih setidaknya satu item untuk dihapus.', '', 'warning');
            event.preventDefault();
        } else {
            Swal.fire({
                title: 'Yakin ingin menghapus semua data terpilih?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data Pembeli telah dihapus.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('deleteAllForm').submit();
                    });
                }
            });
        }
    });
</script>

@endsection
