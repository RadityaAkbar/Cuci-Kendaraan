<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Konfirmasi</title>
</head>
<body style="background-color: rgb(235, 235, 235)">
    
  <form action="/user-add" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container w-25 mt-4 mb-4 p-4 bg-white rounded">
        <h2>Konfirmasi Pesanan</h2>
        <hr>

      <div class="row">
        <p><b>Tanggal :</b> <input type="text" name="tgl_pesan" value="{{ $pesanan->tgl_pesan }}" class="border-0" readonly></p>
      </div>

      <input type="text" value="{{ $pesanan->no_pesanan }}" name="no_pesanan" style="display: none">

      <div class="row">
        <p><b>Nama :</b> <input type="text" name="nama" value="{{ $pesanan->nama }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Plat Nomor :</b> <input type="text" name="plat_nomor" value="{{ $pesanan->plat_nomor }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Jenis Kendaraan :</b><input type="text" style="display: none;" name="kategori_id" value="{{ $pesanan->kategori_id }}" class="border-0" readonly>
          <input type="text" value="{{ $kate->name }}" class="border-0" readonly>
        </p>
      </div>
      <div class="row">
        <p><b>Layanan Cuci :</b><input type="text" style="display: none;" name="jeniscuci_id" value="{{ $pesanan->jeniscuci_id }}" class="border-0" readonly>
          <input type="text" value="{{ $cuci->name }}" class="border-0" readonly>
        </p>
      </div>
      <div class="row">
        <p><b>Harga Kategori :</b><input type="text" name="harga_kategori" value="{{ $pesanan->harga_kategori }}" class="border-0" readonly></p>
      </div>
      <div class="row mb-5">
        <p><b>Harga Cuci : </b><input type="text" name="harga_cuci" value="{{ $pesanan->harga_cuci }}" class="border-0" readonly></p>
      </div>
      <hr>
      <div class="row">
        <p><b>Subtotal :</b> <input type="text" name="subtotal" value="{{ $pesanan->subtotal }}" class="border-0" readonly></p>
      </div>
      
      <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
      <a href="/" class="btn btn-danger ml-1">Batal</a>
    </div>
  </form>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>