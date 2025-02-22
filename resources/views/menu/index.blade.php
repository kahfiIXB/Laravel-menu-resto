@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>Halaman Menu</b></div>

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

                    <form id="menuForm" action="{{ route('menu.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Menu</label>
                                    <input type="number" name="harga" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stok Menu</label>
                                    <input type="number" name="stok" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pesan</label>
                                    <input type="datetime-local" name="waktu" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" id="submitBtn">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="deleteAllForm" action="{{ route('menu.deleteMultiple') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Nama Menu</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Waktu</th>
                                        <th>Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $item->id }}" class="checkbox"></td>
                                        <td>{{ $item->nama_menu }}</td>
                                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->kategori ? $item->kategori->nama_kategori : 'Kategori tidak ditemukan' }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>
                                            <a href="{{ route('menu.show', $item->id) }}" class="btn btn-info">Show</a>
                                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $item->id }}">Delete</button>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>    
                            <button type="button" class="btn btn-danger" id="deleteAllBtn">Delete All</button>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
       
        document.getElementById('menuForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Sukses!',
                text: 'Data Menu Berhasil Ditambahkan',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                event.target.submit();
            });
        });

       
        document.getElementById('selectAll').addEventListener('click', function() {
            document.querySelectorAll('.checkbox').forEach(checkbox => {
                checkbox.checked = this.checked;
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
            event.preventDefault();
            let checkboxes = document.querySelectorAll('.checkbox:checked');
            if (checkboxes.length === 0) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Pilih setidaknya satu item untuk dihapus.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Semua item yang dipilih akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                        title: 'Berhasil!',
                        text: 'Menu telah dihapus.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('deleteAllForm').submit();
                    });
                    }
                });
            }
        });
    });
</script>
@endsection
