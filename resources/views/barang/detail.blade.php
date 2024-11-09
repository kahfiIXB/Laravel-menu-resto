@extends('template.template')

@section('header-area')
<div class="col-md-12">
    <div class="card p-2" style="background-color: #173158;">
        <div class="card-body text-white">
            <!-- Area Judul -->
            <h3>{{$data->nama_barang}}</h3>
            <p class="text-white"></p>
            <div class="button-area">
                <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#modalForm">Edit </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body-area')
<div class="col-md-12">
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Nama Barang</th>
                            <td>{{$data->nama_barang}}</td>
                        </tr>
                        <tr>
                            <th>Merek </th>
                            <td>{{$data->merek}}</td>
                        </tr>
                        <tr>
                            <th>Harga  </th>
                            <td>{{$data->harga}}</td>
                        </tr>
                        <!-- <tr>
                            <th>Stok</th>
                            <td>{{$data->harga}}</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form action="{{route('update-barang', $data->id)}}" method="post">
            @csrf
            {{method_field('put')}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3 fw-bold shadow p-3  bg-body-tertiary rounded">
                        <div class="form-group">
                            <label> Nama Barang:</label>
                            <input type="text" name="nama_barang" value="{{$data->nama_barang}}" require class="form-controller">
                        </div>
                    </div>
                    <!-- merek -->
                    <div class="col-md-d mb-2 fw-bold shadow p-3  bg-body-tertiary rounded">
                        <div class="form-group">
                            <label> Merek:  </label>
                            <input type="text" name="merek" require value="{{$data->merek}}" class="form-controller">
                        </div>
                    </div>
                    <!-- harga -->
                    <div class="col-md-d fw-bold shadow p-3  bg-body-tertiary rounded">
                        <div class="form-group">
                            <label>Harga:   </label>
                            <input type="number" name="harga" require value="{{$data->harga}}" class="form-controller">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
        

      
    </div>
  </div>
</div>
@endsection