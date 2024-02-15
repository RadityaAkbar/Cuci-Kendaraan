<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Akun</title>
</head>
<body>
    
    <div class="container-fluid col-11">
        <div class="row justify-content-between mt-3 p-3">
            <h1 class="h3">Akun Saya</h1>
            <a href="/"><i class="fa fa-home" style="font-size:28px; color:black"></i></a>
        </div>
        
        <div class="row">
            <div class="col-md-5 col-xl-3">
    
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pengaturan Akun</h5>
                    </div>
    
                    <div class="list-group list-group-flush" role="tablist">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                          Profil
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
                          Ganti Password
                        </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#pesanan" role="tab">
                            Pesanan
                          </a>
                    </div>
                </div>
            </div>
    
            <div class="col-md-7 col-xl-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="account" role="tabpanel">
    
                        <div class="card">
                            <div class="card-header">
                                <div class="card-actions float-right">
                                    <div class="dropdown show">
                                        <a href="#" data-toggle="dropdown" data-display="static">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>
    
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="card-title mb-0">Profil Saya</h5>
                            </div>
                            <div class="card-body">
                                <form action="/edit-profil" id="formProfil" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="name_field">Nama</label>
                                                <input type="text" class="form-control input-field" name="name" id="name_field" value="{{Auth::user()->name}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="email_field">Email</label>
                                                <input type="text" class="form-control input-field" name="email" id="email_field" value="{{Auth::user()->email}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor_hp_field">Nomor Handphone</label>
                                                <input type="text" class="form-control input-field" name="nomor_hp" id="nomor_hp_field" value="{{Auth::user()->nomor_hp}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-4">
                                            <div class="text-center">
                                                <img src="{{ asset('images/profil/'.Auth::user()->image) }}" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                                <p>Ganti Foto</p>
                                            </div>
                                        </div>
                                    </div>
    
                                    <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>
                                    <button type="button" class="btn btn-light border border-dark" id="edit">Edit</button>
                                </form>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Password</h5>
                                
                                @if ($errors->has('current_password'))
                                    <div class="alert alert-danger">
                                        <p>Password lama yang Anda masukkan salah.</p>
                                    </div>
                                @elseif ($errors->has('new_password'))
                                    <div class="alert alert-danger">
                                        <p>Password baru harus minimal 8 karakter.</p>
                                    </div>
                                @elseif ($errors->has('new_password_confirmation'))
                                    <div class="alert alert-danger">
                                        <p>Password baru tidak boleh sama dengan password lama.</p>
                                    </div>
                                @endif

                                <form action="/edit-pass" method="POST" enctype="multipart/form-data" id="password-form">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputPasswordCurrent">Current password</label>
                                        <input type="password" class="form-control" id="inputPasswordCurrent" name="current_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew">New password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordNew2">Verify password</label>
                                        <input type="password" class="form-control" id="inputPasswordNew2" name="new_password_confirmation">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
    
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pesanan" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pesanan Anda</h5>
    
                                <table class="table border-bottom text-center col-12">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal/Jam</th>
                                            <th>Nama</th>
                                            <th>Kendaraan</th>
                                            <th>Nomor Plat</th>
                                            <th>Status</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $data)
                                        <tr>
                                          <td>{{$loop->iteration}}</td>
                                          <td>{{$data->tanggal}}{{$data->jam_cuci}}</td>
                                          <td>{{$data->nama}}</td>
                                          <td>{{$data->kategori->name}}</td>
                                          <td>{{$data->plat_nomor}}</td>
                                          <td>{{$data->status->name}}</td>
                                          <td>Rp. {{$data->subtotal}}</td>
                                          <td>
                                            <a 
                                            href="javascript:void(0)"
                                            id="show-pesanan"
                                            data-url="{{ route('customer.show', $data->id) }}"
                                            class="btn btn-info"
                                            ><i class="fa fa-info-circle"></i></a>
                                            @if ($data->status_id > 1)
                                                <a href="/export-pdf/{{$data->id}}" class="btn btn-danger"><i class="fa fa-file-pdf"></i></a>
                                            @else 
                                                <a href="#" class="btn btn-success"><i class="fa fa-dollar"></i></a>
                                            @endif
                                          </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <div class="my-2">
                                    {{$pesanan->withQueryString()->links()}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  
  <!-- Modal Ganti Foto -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/edit-foto" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-outline">
                <p><b>Pilih Foto</b></p>
                <div class="d-flex justify-content-around mb-1">
                  <img src="{{ asset('images/profil/pp-1.jpg') }}" style="width:70px; border-radius:100%">
                  <img src="{{ asset('images/profil/pp-2.jpg') }}" style="width:70px; border-radius:100%">
                  <img src="{{ asset('images/profil/pp-3.jpg') }}" style="width:70px; border-radius:100%">
                  <img src="{{ asset('images/profil/pp-4.jpg') }}" style="width:70px; border-radius:100%">
                </div>
              </div>

              <div class="form-outline mb-1 d-flex justify-content-around">
                <input type="radio" name="image" value="pp-1.jpg" id="image">
                <input type="radio" name="image" value="pp-2.jpg" id="image">
                <input type="radio" name="image" value="pp-3.jpg" id="image">
                <input type="radio" name="image" value="pp-4.jpg" id="image">
              </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal View Detail Start -->
  <div class="modal fade" id="pesananShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p><strong>Tanggal Pesan :</strong> <span id="pesanan-tgl_pesan"></span></p>
            <p><strong>No.Pesanan :</strong> <span id="pesanan-no_pesanan"></span></p>
            <p><strong>Nama :</strong> <span id="pesanan-nama"></span></p>
            <p><strong>Plat Nomor :</strong> <span id="pesanan-plat_nomor"></span></p>
            <p><strong>Jenis Cuci :</strong> <span id="pesanan-jeniscuci"></span></p>
            <p><strong>Jenis Kendaraan :</strong> <span id="pesanan-kategori"></span></p>
            <p><strong>Harga Cuci :</strong> <span id="pesanan-hargacuci"></span></p>
            <p><strong>Harga Kategori :</strong> <span id="pesanan-hargakategori"></span></p>
            <p><strong>Subtotal :</strong> <span id="pesanan-subtotal"></span></p>
            <p><strong>Metode Bayar :</strong> <span style="text-transform: capitalize;" id="pesanan-metode"></span></p>
            <p><strong>Status :</strong> <span id="pesanan-status"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <script src="https://kit.fontawesome.com/a20813204a.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        const buttons = document.querySelectorAll(".btn-light");
    
            for (const button of buttons) {
                button.addEventListener("click", () => {
                    const inputFields = document.querySelectorAll(".input-field");
    
                    for (const inputField of inputFields) {
                    inputField.removeAttribute("readonly");
                    }
                });
            }

        const simpanButton = document.getElementById("simpan");
        const editButton = document.getElementById("edit");

        editButton.addEventListener("click", () => {
        simpanButton.disabled = false;
        });

        // Simpan button initially disabled
        simpanButton.disabled = true;
    </script>
    <script type="text/javascript">
        $(function() {
        $('#simpan').click(function(e) {
            e.preventDefault();

            Swal.fire({
            title: "Simpan Perubahan Profil?",
            text: "Perubahan Profil Akan Disimpan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/edit-profil',
                method: 'POST',
                data: new FormData($('#formProfil')[0]), // Access form data directly
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        title: "Sukses!",
                        text: "Berhasil Mengupdate Profil.",
                        icon: "success",
                        confirmButtonText: "Ok",
                    }).then((result2) => {
                        if (result2.isConfirmed) {
                            // Redirect ke link href
                            window.location.href = '/profil';
                        }
                    });
                },
                error: function(error) {
                    // Tampilkan pesan error
                    Swal.fire(
                    "Gagal!",
                    "Terjadi Kesalahan Saat Mengupdate Profil!",
                    "error"
                    );
                }
                });
            }
            });
        });
        });

    </script>
    <script type="text/javascript">
       
        $(document).ready(function () {
            
            $('body').on('click', '#show-pesanan', function () {
              var pesananURL = $(this).data('url');
              $.get(pesananURL, function (data) {
                $('#pesananShowModal').modal('show');
                $('#pesanan-tgl_pesan').text(data.tgl_pesan);
                $('#pesanan-no_pesanan').text(data.no_pesanan);
                $('#pesanan-nama').text(data.nama);
                $('#pesanan-plat_nomor').text(data.plat_nomor);
                $('#pesanan-jeniscuci').text(data.jeniscuci.name);
                $('#pesanan-kategori').text(data.kategori.name);
                $('#pesanan-hargacuci').text(data.harga_cuci);
                $('#pesanan-hargakategori').text(data.harga_kategori);
                $('#pesanan-subtotal').text(data.subtotal);
                $('#pesanan-status').text(data.status.name);
                $('#pesanan-metode').text(data.metode_bayar);
              })
           });
            
        });
    </script>
</body>
</html>