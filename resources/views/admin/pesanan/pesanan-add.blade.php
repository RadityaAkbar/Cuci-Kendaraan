@extends('layouts.adminlayout')
@section('title', 'Pesanan-Add')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>Pesanan/Add</b></h1>
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
            <h1 class="card-title">Tambah Pesanan</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/pesanan/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="no_pesanan" class="col-sm-2 col-form-label">No Pesanan :</label>
                <div class="col-sm-10">
                  <input type="text" name="no_pesanan" class="form-control" id="no_pesanan" value="{{$no_pesan}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Jenis Kendaraan :</label>
                <div class="col-sm-10">
                  <Select name="kategori_id" id="kategori" class="form-control" required>
                      <option value="">Pilih Kendaraan</option>
                      @foreach ($kategori as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </Select>
                </div>
              </div>

              <div class="form-group row">
                <label for="plat_nomor" class="col-sm-2 col-form-label">Plat Nomor :</label>
                <div class="col-sm-10">
                  <input type="text" name="plat_nomor" class="form-control" id="plat_nomor" placeholder="Masukkan Plat Nomor" required>
                </div>
              </div>

              <div class="form-group row">
                  <label for="jeniscuci" class="col-sm-2 col-form-label">Jenis Cuci :</label>
                  <div class="col-sm-10">
                  <Select name="jeniscuci_id" id="jeniscuci" class="form-control" required>
                      <option value="">Pilih Jenis Cuci</option>
                      @foreach ($jeniscuci as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                  </Select>
                </div>
              </div>

              {{-- <input type="number" class="form-control" value="{{Auth::user()->id}}" style="display:"> --}}
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Tambah</button>
              <a href="/pesanan" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    