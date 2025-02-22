@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Perhitungan Total Harga Menu</b></div>

                <div class="card-body">
                    <!-- Form Filter Tanggal -->
                    <form action="{{ route('pembeli.price') }}" method="GET">
                        <div class="form-group">
                            <label for="nama_pembeli">Cari Nama</label>
                            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" value="{{ request('nama_pembeli') }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_membeli">Pilih Tanggal</label>
                            <input type="date" name="waktu_membeli" id="waktu_membeli" class="form-control" value="{{ request('waktu_membeli') }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Filter</button>
                    </form>

                    <hr>

                    <h5>Daftar Pembeli</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Pembeli</th>
                                    <th>Nama Menu</th>
                                    <th>Total Harga</th>
                                    <th>Waktu Pembelian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($pembelis->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data untuk tanggal yang dipilih.</td>
                                    </tr>
                                @else
                                    @foreach ($pembelis as $pembeli)
                                    <tr>
                                        <td>{{ $pembeli->nama_pembeli }}</td>
                                        <td>{{ $pembeli->menu_nama }}</td> <!-- Sudah digabung -->
                                        <td>Rp {{ number_format($pembeli->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $pembeli->waktu_membeli }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <h5>Total Harga Semua Menu</h5>
                    <p><b>Rp {{ number_format($TotalHarga, 0, ',', '.') }}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
