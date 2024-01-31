<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="width: 50%; margin: auto;">
        <fieldset>
            <h1 style="text-align: center;">C000000001</h1>
        </fieldset>

        @foreach ($pesanan as $item)
        <table border="1" style="border-collapse: collapse; margin: auto; width: 60%; margin-top: 5%;">
            <tbody>
                <tr>
                   <td><b>Tanggal Pesan</b></td>
                   <td>{{$item->tgl_pesan}}</td> 
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td>{{$item->nama}}</td> 
                 </tr>
                 <tr>
                    <td><b>Plat Nomor</b></td>
                    <td>{{$item->plat_nomor}}</td> 
                 </tr>
                 <tr>
                    <td><b>Jenis Kendaraan</b></td>
                    <td>{{$item->kategori->name}}</td> 
                 </tr>
                 <tr>
                    <td><b>Layanan Cuci</b></td>
                    <td>{{$item->jeniscuci->name}}</td> 
                 </tr>
                 <tr>
                    <td><b>Harga Kategori</b></td>
                    <td>{{$item->harga_kategori}}</td> 
                 </tr>
                 <tr>
                    <td><b>Harga Layanan Cuci</b></td>
                    <td>{{$item->harga_cuci}}</td> 
                 </tr>
                 <tr>
                    <td><b>SubTotal</b></td>
                    <td>{{$item->subtotal}}</td> 
                 </tr>
            </tbody>
        </table>
        @endforeach
    </div>
</body>
</html>