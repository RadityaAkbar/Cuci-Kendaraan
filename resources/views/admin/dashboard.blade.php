@extends('layouts.adminlayout')
@section('title', 'Dashboard')
    
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><b>Dashboard/Home</b></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $pesanan }}</h3>

                <p>Jumlah Pesanan</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="/pesanan" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $user }}</h3>

                <p>Jumlah Customer</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="/customer" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $selesai }}</h3>

                <p>Pesanan Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="/pesanan" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <bodiv class="small-box bg-danger">
              <div class="inner">
                <h3>Rp {{ number_format($pendapatan->total_pendapatan, 0, ',', '.') }}</h3>

                <p>Pendapatan Bulan Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-card-outline"></i>
              </div>
              <a href="/pesanan" class="small-box-footer">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      {{-- Content --}}
    </section>
    <!-- /.content -->
@endsection

