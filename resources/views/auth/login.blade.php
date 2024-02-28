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
    background-color: rgb(112, 232, 250);
    /* background-size: cover; */
  }
</style>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center flex-column">

        <!-- Section: Design Block -->
<section class=" text-center text-lg-start">
    <div class="card mb-1 d-flex " style="width: 150%; right:25%;">
      <div class="row g-4 d-flex align-items-center">
        <div class="col-lg-4 d-none d-lg-flex">
          <img style="width: 300px;" src="{{asset('images/picture1.jpg')}}" 
            class="rounded-t-5 rounded-tr-lg-5 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">
          <h2 style="margin-left: 30px;"><b>Login</b></h2>
          <div class="card-body py-4 px-md-4">
            @if (Session::has('status'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
            <form method="POST" action="">
                @csrf
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="email">Email address</label>
                <input class="form-control" type="email" name="email" id="email" required>
              </div>
  
              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
                {{-- <a href="/forgot">Lup?</a> --}}
              </div>
  
              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-4">
                {{-- <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                  </div>
                </div> --}}
  
                <div class="col">
                  <!-- Simple link -->
                  <a href="/register">Tidak Punya Akun?</a>
                </div>
                <div>
                  <a href="/forgot">Lupa Password?</a>
                </div>
              </div>
  
              <!-- Submit button -->
              <button type="submit" class="btn btn-primary btn-block mb-4">Log-In</button>
              <a href="/" class="btn btn-danger btn-block mb-4">Kembali</a>
            </form>
  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
      @if (session()->has('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session()->get('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>
</html>