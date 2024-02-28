<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DitWash</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
    rel="stylesheet"
    />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- My Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>

  <body>

    <!-- Navbar Start -->
    <nav class="navi">
      <a href="#" class="navi-logo">Dit<span>Wash</span>.</a>

      <div class="navi-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#pesan">Pemesanan</a>
      </div>

      <div class="navi-extra">
        @if (Auth::check())
            <div class="profile-menu" style="cursor: pointer">
              <img src="{{ asset('images/profil/'.Auth::user()->image) }}" onclick="toggleMenu()">
              <div class="dropdown-content" id="dropdowncontent">
                @if (Auth::user()->role_id == 1)
                    <a href="/dashboard"><i data-feather="pie-chart"> </i>Dashboard</a>
                @endif
                <a href="/profil"><i data-feather="user"> </i>Akun</a>
                <a href="/logout"><i data-feather="log-out"> </i>Logout</a>
              </div>
            </div>
        @else
            <a href="/login" class="button">Login</a>
        @endif
        
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- Navbar Finish -->

      <!-- Hero Section Start -->
    <section class="hero" id="home">
      <main class="konten">
        <h1>Cuci Kendaraan Hingga<span> Kinclong!</span></h1>
        <p>Murah Cepat Wangi dan Kinclong</p>
        <a href="#pesan" class="cta">Pesan Sekarang</a>
      </main>
      
    </section>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <section id="about" class="about">
      <h2><span>Tentang</span> Kami</h2>
      <p>Ingin Tahu Tentang Kami?</p>

      <div class="baris">
        <div class="about-image">
          <img src="{{ asset('images/slider1.jpg') }}" alt="Tentang Kami">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.067445064236!2d112.75180577476011!3d-7.2331479927730165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f90455d8efbd%3A0x51bbd0b6f4ba8832!2sKomp.%20Sidotopo%20Dipo%2C%20Sidotopo%2C%20Kec.%20Semampir%2C%20Surabaya%2C%20Jawa%20Timur%2060152!5e0!3m2!1sid!2sid!4v1708406528513!5m2!1sid!2sid" width="700" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        
        <div class="konten">
          <h3>Kenapa memilih jasa kami?</h3>
          <div class="tentang">
            <p>DitWash adalah solusi terbaik untuk menjaga kendaraan anda tetap bersih dan berkilau.
              Kami menawarkan berbagai layanan cuci mobil yang dapat disesuaikan dengan kebutuhan anda, mulai dari cuci standar hingga premium.
              Tim kami yang berpengalaman dan profesional akan memastikan bahwa kendaraan anda mendapatkan perawatan terbaik.
            </p>
          </div>
          
          <h3>Layanan Kami</h3>
          <p><b>Cuci Reguler </b>adalah layanan cuci kami yang menggunakan sabun cuci yang berkualitas dijamin bersih dan kinclong </p>
          <p><b>Cuci Premium </b>adalah layanan cuci kami yang terbaik, mencuci bersih segala sudut kendaraan anda secara menyeluruh hingga kinclong </p>
          <div class="layanan">
            <div class="layanan-left">
              <h4>Harga Kategori</h4>
              <ul>
                <li>Mobil : Rp 10.000</li>
                <li>Motor : Rp 5.000</li>
              </ul>
            </div>
            <div class="layanan-right">
             <h4>Harga Layanan Cuci</h4>
             <ul>
              <li>Cuci Reguler : Rp 15.000</li>
              <li>Cuci Premium : Rp 25.000</li>
            </ul>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- About Section End -->

    <!-- Pemesanan Section Start -->
      <section class="pemesanan" id="pesan">
        <h2><span>Form</span> Pemesanan</h2>
        <p>
          Silahkan Isi Form Pesanan Dibawah Ini!
        </p>
        
        <div class="row">
          <form action="/konfirmasi" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="form-left">
                  <input type="text" id="nopesan" name="no_pesanan" value="{{$no_pesan}}" style="display: none">

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" @if(Auth::check())
                   value="{{Auth::user()->name}}"@endif placeholder="Masukkan Nama" required>
                </div>
                
                <div class="form-group">
                  <label for="kategori">Jenis Kendaraan</label>
                  <div class="select-container">
                    <Select name="kategori_id" id="kategori" class="select-box" required>
                        <option value="" selected disabled>Pilih Kendaraan</option>
                        @foreach ($kategori as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </Select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="plat_nomor">Plat Nomor</label>
                  <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" placeholder="Plat Nomor Kendaraan" required>
                </div>
              </div>

              <div class="form-right">
                <div class="form-group">
                  <label for="tanggal">Tanggal Pesan</label>
                  <input type="date" class="form-control" id="inputdate" name="tgl_pesan" value="{{$tanggal}}">
                </div>

                <div class="form-group">
                  <label for="jeniscuci">Jenis Cuci</label>
                  <div class="select-container">
                    <Select name="jeniscuci_id" id="jeniscuci" class="select-box" required>
                        <option value="" selected disabled>Pilih Jenis Cuci</option>
                        @foreach ($jeniscuci as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </Select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="bayar">Pembayaran</label>
                  <div class="select-container">
                    <Select id="bayar" class="select-box" name="metode_bayar">
                        <option value="" selected disabled>Pilih Metode Bayar</option>
                        <option value="tunai">Tunai (DP Sesuai Harga Kategori)</option>
                        <option value="non-tunai">Non-Tunai</option>
                    </Select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="jamcuci">Jam Cuci</label>
                  <div class="select-container">
                    <Select name="jam_cuci" id="jamcuci" class="select-box" required>
                      <option value="" selected disabled>Pilih Jam Cuci</option>
                      @if (empty($jamCuciTersedia))
                          <option value="" selected disabled>Pilih Jam Cuci (Tidak Ada Jam Tersedia)</option>
                      @else
                          <option value="" selected disabled>Pilih Jam Cuci</option>
                          @foreach ($jamCuciTersedia as $jam)
                              <option value="{{ $jam }}">{{ $jam }}</option>
                          @endforeach
                      @endif
                    </Select>
                  </div>
                  @if (Session::has('status'))
                    <p role="alert" style="color: red;">
                      *{{Session::get('message')}}
                    </p>
                  @endif
                </div>
                
              </div>
            </div>
            <div class="form-footer">
              <button class="button" type="submit">Pesan</button>
            </div>
          </form>
        </div>
      </section>
      <!-- Pemesanan Section End -->
    

    {{-- {{-- <!-- Kategori Section Start --> --}}
    <section class="kategori" id="ulasan">
      <div class="row">
        <div class="kategori-card">
          <h2>Hubungi Kami</h2>
          <p>Jika anda mengalami masalah,</p>
          <p>silahkan hubungi kontak dibawah ini</p><br>
          <div class="icon"><i data-feather="mail"></i><a href="mailto: raditwirayudha3@gmail.com"><p>raditwirayudha3@gmail.com</p></a></div>
          <div class="icon"><i data-feather="phone"></i><p>0895414444168</p></div>
          <p></p>
        </div>
        <div class="kategori-card">
          <h2>Waktu Operasional</h2>
          <p><b>Senin-Minggu</b> 08:00-20:00</p>
        </div>
      </div>
    </section>
    <!-- Kategori Section End -->

    {{-- <!-- Momen Section Start -->
    <section class="momen" id="momen">
      <h2><span>Momen</span> Hangat</h2>

      <div class="row">
        <div class="momen-img">
          <img src="img/Savage.jpg" alt="alter" />
        </div>
        <div class="content">
          <h3>Alter Ego Berhasil Menaklukkan Sang Raja</h3>
          <p>
            Savage pertama terjadi di MPLID S10 Week 4 Day 3, pada pertemuan antara Alter Ego dengan RRQ. Alter Ego berhasil menang dengan skor 2-1, di game ketiga Nino mendapat Savage. RRQ menelan kekalahan dua kali beruntun di
            pekan keempat. Setelah dibungkam Geek Slate, RRQ juga harus mengakui
            kekalahannya dari Alter Ego.
          </p>
          <p>
            Alter Ego yang terpuruk dengan enam kekalahan di paruh pertama
            bertransformasi menjadi tim yang sangat mengerikan di awal paruh
            kedua.<h1>Baca Selengkapnya...</h1>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="momen-img">
          <img src="img/timnas.jpg" alt="alter" />
        </div>
        <div class="content">
          <h3>Terungkap! Ini tanggal pengumuman roster Timnas Esports Indonesia SEA Games 2023</h3>
          <p>
            Timnas Esports Indonesia untuk SEA Games 2023 tak lama lagi setelah tanggal pengumuman akhirnya diumumkan. Hal ini terjadi ketika Sekjen PBESI, Frenky Ong, mengungkapkannya pada Instagram Story.
          </p>
          <p>
            Demi hasil SEA Games 2023 yang jauh lebih baik dari sebelumnya, persiapan dalam pembentukan timnas esports untuk enam cabang yang diperlombakan pun jauh lebih lama ketimbang dua SEA Games terdahulu yang mepet.<h1>Baca Selengkapnya...</h1>
          </p>
        </div>
      </div>
    </section>
    <!-- Momen Section End --> --}}

    <!-- Footer Start -->
    <footer>
      <div class="social">
        <a href=""><i data-feather="instagram"></i></a>
        <a href=""><i data-feather="twitter"></i></a>
        <a href=""><i data-feather="facebook"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#about">Tentang Kami</a>
        <a href="#pesan">Pemesanan</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">Raditya A.W</a>. | &copy; 2023.</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Feather-Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="{{ asset('js\script.js') }}"></script>
  
    <script>
      let dropdowncontent = document.getElementById("dropdowncontent");

      function toggleMenu() {
        dropdowncontent.classList.toggle("open")
      }
    </script>
    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session()->get('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session()->has('failed'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session()->get('failed') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script type="text/javascript">
      $(function(){
          var dtToday = new Date();
       
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
           day = '0' + day.toString();
          var maxDate = year + '-' + month + '-' + day;
          $('#inputdate').attr('min', maxDate);
      });
      </script>
    
  </body>
</html>
