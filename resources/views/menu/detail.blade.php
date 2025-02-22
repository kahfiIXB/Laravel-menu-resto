@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Detail Menu</b></div>

                <div class="card-body">
                    <form id="updateForm" action="{{ route('menu.update', $menu->id) }}" method="post">
                        @csrf
                        {{ method_field('put') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu" class="form-control" value="{{ $menu->first()->nama_menu }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga Menu</label>
                                    <input type="number" name="harga" class="form-control" value="{{ $menu->harga }}" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Stok Menu</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $menu->stok }}" required>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" value="{{ $menu->deskripsi }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ $menu->id_kategori == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pesan</label>
                                    <input type="date" name="waktu" class="form-control" value="{{ $menu->waktu }}" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" id="updateButton">Ubah Menu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button id="backButton" class="btn btn-secondary mt-3">Kembali</button>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header"><b>Daftar Pembeli dalam Menu Ini</b></div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pembeli</th>
                                <th>Waktu Pembelian</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($menu->pembeli) && $menu->pembeli->count() > 0)
                            @foreach($menu->pembeli as $index => $pembeli)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pembeli->nama_pembeli }}</td>
                                    <td>{{ $pembeli->waktu_membeli }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada pembeli</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('updateButton').addEventListener('click', function(event) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Konfirmasi Perubahan',
            text: "Apakah Anda yakin ingin mengubah data menu ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                        title: 'Berhasil!',
                        text: 'Kategori telah diperbarui.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('updateForm').submit();
                    });
            }
        });
    });
    document.getElementById('backButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Kembali ke daftar?',
            text: "Anda akan kembali ke halaman daftar pembelian.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembali!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('menu.index') }}";
            }
        });
    });
</script>

@endsection
