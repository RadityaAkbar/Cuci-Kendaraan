@extends('layouts.adminlayout')
@section('title', 'Pesanan-Edit')

@section('content')
<section class="content-header">
  <div class="container-fluid ml-1">
      <div class="row">
          <div class="col-sm-6">
          <h1><b>Pesanan/Edit</b></h1>
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
            <h1 class="card-title">Edit Pesanan</h1>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/pesanan/edit/{{$pesanan->id}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
              <div class="form-group row">
                <label for="tgl_pesan" class="col-sm-2 col-form-label">Tanggal Pesanan :</label>
                <div class="col-sm-10">
                  <input type="text" name="tgl_pesan" class="form-control" id="tgl_pesan" value="{{$pesanan->tgl_pesan}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="no_pesanan" class="col-sm-2 col-form-label">No.Pesanan :</label>
                <div class="col-sm-10">
                  <input type="text" name="no_pesanan" class="form-control" id="no_pesanan" value="{{$pesanan->no_pesanan}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama :</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="nama" value="{{$pesanan->nama}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="plat_nomor" class="col-sm-2 col-form-label">Plat Nomor :</label>
                <div class="col-sm-10">
                  <input type="text" name="plat_nomor" class="form-control" id="plat_nomor" value="{{$pesanan->plat_nomor}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="jeniscuci" class="col-sm-2 col-form-label">Jenis Cuci :</label>
                <div class="col-sm-10">
                  <input type="text" name="jeniscuci" class="form-control" id="jeniscuci" value="{{$pesanan->jeniscuci->name}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="plat_nomor" class="col-sm-2 col-form-label">Jenis Kendaraan :</label>
                <div class="col-sm-10">
                  <input type="text" name="plat_nomor" class="form-control" id="plat_nomor" value="{{$pesanan->kategori->name}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="plat_nomor" class="col-sm-2 col-form-label">Subtotal :</label>
                <div class="col-sm-10">
                  <input type="text" name="plat_nomor" class="form-control" id="plat_nomor" value="{{$pesanan->subtotal}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Jenis Cuci :</label>
                  <div class="col-sm-10">
                    <Select name="status_id" id="status" class="form-control">
                        <option value="{{$pesanan->status->id}}">{{$pesanan->status->name}}</option>
                        @foreach ($status as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </Select>
                  </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <a href="/pesanan" class="btn btn-danger">Batal</a>
            </div>
          </form>
        </div>
      </div>
        <!-- /.card -->
</section>
@endsection    