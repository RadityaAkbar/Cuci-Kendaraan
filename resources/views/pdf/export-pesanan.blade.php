<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
   <style>
   *{
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
   }
   body{
      height: 100vh;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #808080;
   }
   .wrapper{
      width: 424px;
      height: 600px;
      background: #fff;
      position: relative;
      padding: 60px 30px;
   }
   .border-design{
      display: flex;
      width: 100%;
      justify-content: flex-end;
   }
   .border-design .c1,
   .border-design .c2,
   .border-design .c3,
   .border-design .c4{
      width: 30px;
      height: 10px;
   }
   .c1, .c4{
      background: rgb(22, 232, 239);
   }
   .c2{
      background: rgb(231, 231, 231);
   }
   .c3{
      background: black;
   }
   .border-design.top{
      position: absolute;
      top: 0;
      right: 0;
   }
   .border-design.bottom{
      position: absolute;
      bottom: 0;
      left: 0;
      flex-direction: row-reverse;
   }
   .invoice-header{
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.5rem;
   }
   .logo{
      text-transform: uppercase;
      font-size: 20px;
      font-weight: 700;
      font-style: italic;
      letter-spacing: -1px;
   }
   .logo span{
      font-weight: 700;
      color: rgb(22, 232, 239);
   }
   .title{
      text-transform: uppercase;
      font-size: 25px;
      font-weight: 600;
      text-align: right;
   }
   .inv-number, .inv-date{
      justify-content: space-evenly;
   }
   .inv-number{
      padding: 10px 45px 0 0;
   }
   .inv-date{
      padding: 10px 0 0 0;
   }
   .inv-number h3, .inv-date h3{
      font-weight: 700;
      font-size: 11px;
   }
   .inv-number h4, .inv-date h4{
      font-weight: 500;
      font-size: 12px;
   }
   .pesanan-detail{
      margin-top: 15px;
   }
   .pesanan-detail p:nth-child(1),
   .pesanan-detail p:nth-child(2){
      text-transform: uppercase;
   }
   .pesanan-detail p:nth-child(1){
      font-size: 10px;
   }
   .pesanan-detail p:nth-child(2){
      font-size: 12px;
      font-weight: 700;
      width: 150px;
      border-bottom: 1px solid #000;
      margin-bottom: 5px;
   }
   .pesanan-detail p:nth-child(3),
   .pesanan-detail p:nth-child(4),
   .pesanan-detail p:nth-child(5){
      font-size: 10px;
   }
   .pesanan-detail p span{
      font-weight: 600;
   }
   .table-title{
      margin-top: 25px;
      font-size: 18px;
      font-weight: 700;
      border-bottom: 1px solid black
   }
   table tbody tr td p{
      font-size: 12px;
      font-weight: 500;
   }
   .terms p:nth-child(1){
      font-size: 12px;
      font-weight: 700;
      width: 150px;
   }
   .terms{
      margin-top: 20px;
   }
   .terms p:nth-child(2),
   .terms p:nth-child(3){
      font-size: 10px;
   }
   .message{
      margin-top: 20px; 
   }
   .message p{
      font-size: 12px;
      font-weight: 700;
   }
</style>
<body>
   @foreach ($pesanan as $item)
       
   <div class="wrapper">
      {{-- <div class="border-design top">
         <div class="c1"></div>
         <div class="c2"></div>
         <div class="c3"></div>
         <div class="c4"></div>
      </div> --}}
      
      <div class="invoice-header">
         <div class="logo">Dit<span>Wash</span>.</div>
         <div class="title">Invoice</div>
         <div class="inv-number">
            <h3>Invoice</h3>
            <h4><b>#</b>{{$item->no_pesanan}}</h4>
         </div>
         <div class="inv-date">
            <h3>Tanggal :</h3>
            <h4>{{$item->tgl_pesan}}</h4>
         </div>
      </div>

      <div class="pesanan-detail">
         <p>Nama</p>
         <p>{{$item->nama}}</p>
         <p><span>Email:</span> {{$item->user->email}}</p>
         <p><span>Kontak:</span> {{$item->user->nomor_hp}}</p>
      </div>

      <p class="table-title">Detail Pesanan</p>
      <table border="0" style="border-collapse: collapse; margin: auto; width: 90%; margin-top: 10px;">
         <tbody>
            <tr>
               <td><h5>Jam Cuci</h5></td>
               <td><p>: {{$item->jam_cuci}}</p></td> 
            </tr>
              <tr>
                 <td><h5>Plat Nomor</h5></td>
                 <td><p>: {{$item->plat_nomor}}</p></td> 
              </tr>
              <tr>
                 <td><h5>Jenis Kendaraan</h5></td>
                 <td><p>: {{$item->kategori->name}}</p></td> 
              </tr>
              <tr>
                 <td><h5>Layanan Cuci</h5></td>
                 <td><p>: {{$item->jeniscuci->name}}</p></td> 
              </tr>
              <tr>
                 <td><h5>Harga Kategori</h5></td>
                 <td><p>: Rp.{{$item->harga_kategori}}</p></td> 
              </tr>
              <tr>
                 <td><h5>Harga Layanan Cuci</h5></td>
                 <td><p>: Rp.{{$item->harga_cuci}}</p></td> 
              </tr>
              <tr>
                 <td><h5>SubTotal</h5></td>
                 <td><p>: Rp.{{$item->subtotal}}</p></td> 
              </tr>
              <tr>
               <td><h5>Metode Bayar</h5></td>
               <td><p style="text-transform: capitalize;">: {{$item->metode_bayar}}</p></td> 
            </tr>
         </tbody>
     </table>

     <div class="terms">
      <p>Syarat & Ketentuan</p>
      <p>Tunjukkan Invoice Ke Tempat Cuci</p>
      <p>*Maksimal Keterlambatan 10 Menit Dari Jam Cuci <br>
         *Jika Melebihi Batas Terlambat Pesanan Akan Dibatalkan
      </p>
     </div>
     <div class="message">
      <p>Terima Kasih Telah Menggunakan Jasa Kami</p>
     </div>
      
      {{-- <div class="border-design bottom">
         <div class="c1"></div>
         <div class="c2"></div>
         <div class="c3"></div>
         <div class="c4"></div>
      </div> --}}
   </div>
   @endforeach
   
   {{-- @foreach ($pesanan as $item)
      <div style="width: 70%; margin: auto;">
         <fieldset>
            <h1 style="text-align: center;">{{$item->no_pesanan}}</h1>
         </fieldset>
         
        <h2 style="">Detail Pesanan</h2>
        <table border="0" style="border-collapse: collapse; margin: auto; width: 60%; margin-top: 5%;">
            <tbody>
                <tr>
                   <td><b>Tanggal Pesan</b></td>
                   <td>: {{$item->tgl_pesan}}</td> 
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td>: {{$item->nama}}</td> 
                 </tr>
                 <tr>
                    <td><b>Plat Nomor</b></td>
                    <td>: {{$item->plat_nomor}}</td> 
                 </tr>
                 <tr>
                    <td><b>Jenis Kendaraan</b></td>
                    <td>: {{$item->kategori->name}}</td> 
                 </tr>
                 <tr>
                    <td><b>Layanan Cuci</b></td>
                    <td>: {{$item->jeniscuci->name}}</td> 
                 </tr>
                 <tr>
                    <td><b>Harga Kategori</b></td>
                    <td>: {{$item->harga_kategori}}</td> 
                 </tr>
                 <tr>
                    <td><b>Harga Layanan Cuci</b></td>
                    <td>: {{$item->harga_cuci}}</td> 
                 </tr>
                 <tr>
                    <td><b>SubTotal</b></td>
                    <td>: {{$item->subtotal}}</td> 
                 </tr>
            </tbody>
        </table>
      </div>
   @endforeach --}}
</body>
</html>