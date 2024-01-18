@extends('layouts.adminlayout')
@section('title', 'Kategori-Add')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>Kategori/Add</b></h1>
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
            <h1 class="card-title">Tambah Kategori</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="add-kategori" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan Kategori">
                </div>
              </div>

              <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga :</label>
                <div class="col-sm-10">
                  <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan Harga">
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Tambah</button>
              <a href="/kategori" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    