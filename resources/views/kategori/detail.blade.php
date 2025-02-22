@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Halaman Kategori</b></div>

                <div class="card-body">
                   <form id="updateKategoriForm" action="{{ route('kategori.update', $data->id) }}" method="post">
                    @csrf
                    {{ method_field('put') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" value="{{ $data->nama_kategori }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Ubah Kategori</button>
                                </div>
                            </div>
                        </div>
                   </form>
                   <button id="backButton" class="btn btn-secondary mt-3">Kembali</button>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Nama Kategori</th>
                                <td>{{ $data->nama_kategori }}</td>
                            </tr>
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header"><b>Daftar Menu dalam Kategori Ini</b></div>
                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->menus as $index => $menu)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert untuk konfirmasi update kategori
        document.getElementById('updateKategoriForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi!',
                text: 'Apakah Anda yakin ingin mengubah kategori ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
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
                        event.target.submit();
                    });
                }
            });
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
                window.location.href = "{{ route('kategori.index') }}";
            }
        });
    });
</script>
@endsection
