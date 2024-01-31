@extends('layouts.adminlayout')
@section('title', 'Laporan')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>Laporan</b></h1>
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
            <h1 class="card-title">Cetak Data Pesanan</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="GET">
            <div class="card-body">
              <div class="d-flex col-12 mb-4 mt-1">
                <div class="col-5">
                    <label for="">Data Mulai Dari :</label>
                    <input type="date" class="form-control" name="tgl_awal">
                </div>
                <div class="col-5">
                    <label for="">Hingga Data :</label>
                    <input type="date" class="form-control" name="tgl_akhir">
                </div>
                <div class="col-1" style="margin-top: 32px;">
                    <button class="btn btn-warning"><span><i class="fa fa-search"></i></span> Cari</button> 
                </div>
              </div>
          </form>

              <table class="table table-striped text-center">
                <thead class="thead bg-light">
                    <tr>
                      <th>#</th>
                      <th>Tgl.Pesan</th>
                      <th>Nama</th>
                      <th>Kategori</th>
                      <th>Jenis Cuci</th>
                      <th>Plat Nomor</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pesanan as $data)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$data->tgl_pesan}}</td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->kategori->name}}</td>
                      <td>{{$data->jeniscuci->name}}</td>
                      <td>{{$data->plat_nomor}}</td>
                      <td>{{$data->status->name}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="/export" class="btn btn-success">Cetak Laporan <span><i class="fas fa-print"></i></span></a>
            </div>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    