<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Konfirmasi</title>
</head>
<body style="background-color: rgb(245, 245, 245)">
    
    <div class="container mt-4 mb-4 p-4 bg-white rounded" style="width: 30%;">
        <h2>Konfirmasi Pesanan</h2>
        <hr>

      <div class="row">
        <p><b>Tanggal :</b> <input type="text" name="tgl_pesan" value="{{ $pesanan->tgl_pesan }}" class="border-0" readonly></p>
      </div>

      <div class="row">
        <p><b>Jam Cuci :</b> <input type="timestamp" name="jam_cuci" value="{{ $pesanan->jam_cuci }}" class="border-0" readonly></p>
      </div>

      <input type="text" value="{{ $pesanan->no_pesanan }}" name="no_pesanan" style="display: none">

      <div class="row">
        <p><b>Nama :</b> <input type="text" name="nama" value="{{ $pesanan->nama }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Plat Nomor :</b> <input type="text" name="plat_nomor" value="{{ $pesanan->plat_nomor }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Jenis Kendaraan :</b> <input type="text" value="{{ $pesanan->kategori->name }}" class="border-0" readonly>
        </p>
      </div>
      <div class="row">
        <p><b>Layanan Cuci :</b> <input type="text" value="{{ $pesanan->jeniscuci->name }}" class="border-0" readonly>
        </p>
      </div>
      <div class="row">
        <p><b>Harga Kategori :</b><input type="text" name="harga_kategori" value="{{ $pesanan->harga_kategori }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Harga Cuci : </b><input type="text" name="harga_cuci" value="{{ $pesanan->harga_cuci }}" class="border-0" readonly></p>
      </div>
      <div class="row">
        <p><b>Metode Bayar : </b><input style="text-transform: capitalize;" type="text" name="metode_bayar" value="{{ $pesanan->metode_bayar }}" class="border-0" readonly></p>
      </div>
      <hr>
      <div class="row">
        <p><b>Subtotal :</b> <input type="text" name="subtotal" value="{{ $pesanan->subtotal }}" class="border-0" readonly></p>
      </div>
      
      <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
      {{-- <button type="submit" class="btn btn-primary">Pesan Sekarang</button> --}}
      <a href="/user-pesanan/{{ $pesanan->id }}" class="btn btn-danger ml-1" id="batal" >Batal</a>
    </div>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

      <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
          // Also, use the embedId that you defined in the div above, here.
          window.snap.pay('{{$snapToken}}', {
            onSuccess: function (result) {
              /* You may add your own implementation here */
              alert("Pembayaran Berhasil!"); console.log(result);
              window.location.href = "/status";
            },
            onPending: function (result) {
              /* You may add your own implementation here */
              alert("Menunggu Pembayaran!"); console.log(result);
            },
            onError: function (result) {
              /* You may add your own implementation here */
              alert("Pembayaran Gagal!"); console.log(result);
            },
            onClose: function () {
              /* You may add your own implementation here */
              alert('Anda Menutup Pop-Up Tanpa Menyelesaikan Pembayaran');
            }
          });
        });
      </script>

      <script type="text/javascript">
        $(function() {
          $(document).on('click', '#batal', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
        
            Swal.fire({
                title: "Anda Yakin Membatalkan Pesanan?",
                text: "Anda Harus Mengisi Form Lagi Jika Membatalkan Pesanan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Batalkan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Dibatalkan!",
                        text: "Pesanan Berhasil Dibatalkan.",
                        icon: "success",
                        confirmButtonText: "Ok",
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            // Redirect ke link href
                            window.location.href = link;
                        }
                    });
                }
            });
          });
        });
      </script>
</body>
</html>