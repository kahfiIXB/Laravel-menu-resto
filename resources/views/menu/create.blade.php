@extends('layouts.app')  

@section('content')  
<div class="container">  
    <h1>Tambah menu</h1>  
    <form action="{{ route('menu.store') }}" method="POST">  
        @csrf  
        <div class="mb-3">  
            <label for="nama" class="form-label">Nama menu</label>  
            <input type="text" class="form-control" id="nama" name="nama" required>  
        </div>  
        <button type="submit" class="btn btn-primary">Simpan</button>  
    </form>  
</div>  
@endsection