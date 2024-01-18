@extends('layouts.adminlayout')
@section('title', 'Kategori')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><b>Layanan/Kategori</b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="d">
            <a href="/kategori-add" class="btn btn-success mb-3"><i class="nav-icon fas fa-plus"></i>
                <span>Tambah Kategori</span>
            </a>

            @if (Session::has('status'))
              <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
              </div>
            @endif
        </div>

        <table class="table text-center">
            <thead class="thead bg-primary">
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($kategori as $data)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$data->name}}</td>
                  <td>Rp.{{$data->harga}}</td>
                  <td>
                    <a href="kategori-edit/{{$data->id}}" class="btn btn-warning"><i class="nav-icon fas fa-edit"></i>Edit</a>
                    <a href="kategori-destroy/{{$data->id}}" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection