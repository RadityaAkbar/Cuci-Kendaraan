<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>

    
    <div class="container w-50 mt-5">
        <div class="card">
            <div class="card-header text-center bg-info">
                Ganti Password
            </div>
            <div class="card-body">
                <h3 class="card-title text-center" style="margin-top: 5px;">Buat Password Baru</h3>
                <p class="card-text text-center">Silahkan Isi Form Password</p>
                <form action="" method="POST" style="margin-top:-20px ">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="newpass">Password Baru</label>
                        <input type="password" class="form-control" placeholder="Password Baru" name="password" required>
                        <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>Minimal 8 Karakter
                    </div>
                    <div>
                        <label for="cpass">Ulangi Password</label>
                        <input type="password" class="form-control" placeholder="Ulangi Password" name="cpassword" required>
                    </div>  
                        <button type="submit" class="btn btn-primary mt-3 col-12">Simpan Password</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session()->has('success'))
        SwalFire.fire({
            title: "Berhasil Ganti Password!",
            text: "Silahkan Login Kembali",
            icon: "success",
            confirmButtonText: "Ok",
            }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke link href
                        window.location.href = '/login';
                    }
                });

        @endif

        @if (session()->has('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session()->get('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
  </body>
</html>