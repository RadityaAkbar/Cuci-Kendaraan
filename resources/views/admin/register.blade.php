<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
  body {
    background-image: url('{{ asset('images/login-bg.jpg') }}');
    background-size: cover;
  }
</style>

<body>
  <div class="vh-100 d-flex justify-content-center align-items-center flex-column">
        <!-- Section: Design Block -->
    <section class=" text-center text-lg-start col-lg-4">
      <div class="card mb-0">
        <div class="row align-items-center">
          
          <div class="col-12">
            <div class="card-body px-md-5">

              @if ($errors->any())
                <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                </div>
              @endif
    
              <form method="POST" action="/signin">
                  @csrf
                <div class="form-outline mb-1">
                  <label class="form-label" for="name"><b>Nama</b></label>
                  <input class="form-control" type="text" name="name" id="name" required>
                </div>

                <div class="form-outline mb-1">
                  <label for="gender" class="col-form-label"><b>Jenis Kelamin</b></label>
                  <div>
                    <Select name="gender" id="gender" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </Select>
                  </div>
                </div>

                <div class="form-outline mb-1">
                  <label class="form-label" for="nomor_hp"><b>No.Handphone</b></label>
                  <input class="form-control" type="text" name="nomor_hp" id="nomor_hp" required>
                </div>

                <div class="form-outline mb-1">
                  <label class="form-label" for="email"><b>Email</b></label>
                  <input class="form-control" type="email" name="email" id="email" required>
                </div>

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

                <div class="form-outline mb-1">
                  <label class="form-label" for="password"><b>Password</b></label>
                  <input class="form-control" type="password" name="password" id="password" required>
                </div>

                <div class="form-outline mb-1">
                  <label for="password_confirmation"><b>Konfirmasi Password</b></label>
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
    
    
                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                  <div class="col">
                    <!-- Simple link -->
                    <a href="/login">Already Have Account?</a>
                  </div>
                </div>
    
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Sign-In</button>
              </form>
    
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>