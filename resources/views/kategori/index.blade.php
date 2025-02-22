@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>halaman kategori</b></div>

                <div class="card-body">
                   <form id="kategoriForm" action="{{route('kategori.store')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="submitKategori">Tambah Kategori</button>
                            </div>
                        </div>
                    </div>
                   </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                   <div class="table-responsive">
                        <form id="deleteAllForm" action="{{ route('kategori.deletemultiple') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <table class="table table-hover">
                                <thead>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Nama Kategori</th>
                                    <th>Pilihan</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item) 
                                    <tr>
                                    <td><input type="checkbox" name="idss[]" value="{{ $item->id }}" class="checkbox"></td>
                                    <td>{{$item->nama_kategori}}</td>
                                    <td>
                                        <a href="{{ route('kategori.show', $item->id) }}" class="btn btn-info">Show</a>
                                        <button type="button" class="btn btn-danger delete-btn" data-id="{{ $item->id }}">Delete</button>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display: none;">
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
    document.getElementById('submitKategori').addEventListener('click', function() {
        Swal.fire({
            title: 'Sukses!',
            text: 'Kategori berhasil ditambahkan!',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('kategoriForm').submit();
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
                        text: 'Kategori telah dihapus.',
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