@extends('layouts.adminlayout')
@section('title', 'Jenis Cuci')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><b>Layanan/Jeniscuci</b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="d">
            <a href="/jeniscuci-add" class="btn btn-success mb-3"><i class="nav-icon fas fa-plus"></i>
                <span>Tambah Layanan Cuci</span>
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
                  <th>Jenis Cuci</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jeniscuci as $data)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$data->name}}</td>
                  <td>Rp.{{$data->harga}}</td>
                  <td>
                    <a href="jeniscuci-edit/{{$data->id}}" class="btn btn-warning"><i class="nav-icon fas fa-edit"></i>Edit</a>
                    <a href="jeniscuci-destroy/{{$data->id}}" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection