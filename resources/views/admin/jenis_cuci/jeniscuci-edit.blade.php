@extends('layouts.adminlayout')
@section('title', 'JenisCuci-Edit')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>JenisCuci/Edit</b></h1>
          </div>
      </div>
  </div>
</section>
<section class="content">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h1 class="card-title">Edit Jenis Cuci</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/jeniscuci/{{$jeniscuci->id}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="name" value="{{$jeniscuci->name}}" >
                </div>
              </div>

              <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga :</label>
                <div class="col-sm-10">
                  <input type="number" name="harga" class="form-control" id="harga" value="{{$jeniscuci->harga}}" >
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="/jeniscuci" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    