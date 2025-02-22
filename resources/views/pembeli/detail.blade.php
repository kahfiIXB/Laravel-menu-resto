@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Detail Pembelian</b></div>

                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pembeli</label>
                                    <input type="text" class="form-control" value="{{ $pembeli->first()->nama_pembeli }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" value="{{ $pembeli->menu->nama_menu }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" value="Rp {{ number_format($pembeli->menu->harga, 0, ',', '.') }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" value="{{ $pembeli->menu->stok }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" rows="3" disabled>{{ $pembeli->deskripsi_pembeli }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Waktu Pembelian</label>
                                    <input type="text" class="form-control" value="{{ date('d-m-Y H:i', strtotime($pembeli->waktu_membeli)) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button id="backButton" class="btn btn-secondary mt-3">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
                window.location.href = "{{ route('pembeli.index') }}";
            }
        });
    });
</script>
@endsection
