@extends('layouts.adminlayout')
@section('title', 'Customer-Edit')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>Customer/Edit</b></h1>
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
            <h1 class="card-title">Edit Customer</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/pesanan/edit/{{$customer->id}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Image :</label>
                <div class="col-sm-10">
                  <input type="text" name="image" class="form-control" id="image" value="{{$customer->image}}">
                </div>
              </div>

              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="name" value="{{$customer->name}}">
                </div>
              </div>

              <div class="form-group row">
                <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
                <div class="col-sm-10">
                  <input type="text" name="gender" class="form-control" id="gender" value="{{$customer->gender}}">
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                  <input type="text" name="email" class="form-control" id="email" value="{{$customer->email}}">
                </div>
              </div>

              <div class="form-group row">
                <label for="nomor_hp" class="col-sm-2 col-form-label">Nomor HP :</label>
                <div class="col-sm-10">
                  <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" value="{{$customer->nomor_hp}}">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="/customer" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    