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
        <a href="#ulasan">Ulasan</a>
      </div>

      <div class="navi-extra">
        <a href="#"><i data-feather="headphones"></i></a>
        @if (Auth::check())
            <div class="profile-menu" style="cursor: pointer">
              <img src="{{ asset('images/pp-1.png')}}" onclick="toggleMenu()">
              <div class="dropdown-content" id="dropdowncontent">
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

      <div class="baris">
        <div class="about-image">
          <img src="{{ asset('images/slider1.jpg') }}" alt="Tentang Kami">
        </div>
        
        <div class="konten">
          <h3>Kenapa memilih jasa kami?</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque reprehenderit sint harum quos temporibus quae!</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque unde consequatur ad molestiae nihil minima iusto odio praesentium voluptatum earum.</p>
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
          <form action="/cek-add" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="form-left">
                  <input type="text" id="nopesan" name="no_pesanan" value="{{$no_pesan}}" style="display: none">

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                </div>
                
                <div class="form-group">
                  <label for="kategori">Jenis Kendaraan</label>
                  <div class="select-container">
                    <Select name="kategori_id" id="kategori" class="select-box" required>
                        <option value="">Pilih Kendaraan</option>
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
                  <input type="text" class="form-control" id="tanggal" name="tgl_pesan" value="{{$tanggal}}" readonly>
                </div>

                <div class="form-group">
                  <label for="jeniscuci">Jenis Cuci</label>
                  <div class="select-container">
                    <Select name="jeniscuci_id" id="jeniscuci" class="select-box" required>
                        <option value="">Pilih Jenis Cuci</option>
                        @foreach ($jeniscuci as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </Select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="bayar">Pembayaran</label>
                  <div class="select-container">
                    <Select id="bayar" class="select-box">
                        <option value="">Pilih Metode Bayar</option>
                        <option value="">Tunai</option>
                        <option value="">Non-Tunai</option>
                    </Select>
                  </div>
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
    

    <!-- Kategori Section Start -->
    <section class="kategori" id="ulasan">
      <h2><span>Kritik</span> & Saran</h2>
      <p>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus
        aspernatur optio nesciunt assumenda. Animi.
      </p>

      <div class="row">
        <div class="kategori-card">
          <img src="img/lane.jpg" alt="moba" />
          <h3 class="kategori-title">- Moba -</h3>
        </div>
        <div class="kategori-card">
          <img src="img/fps.jpg" alt="tembak" />
          <h3 class="kategori-title">- First Person Shooter -</h3>
        </div>
        <div class="kategori-card">
          <img src="img/royal.jpg" alt="loot" />
          <h3 class="kategori-title">- Battleroyale -</h3>
        </div>
        <div class="kategori-card">
          <img src="img/grind.jpg" alt="level" />
          <h3 class="kategori-title">- MMORPG -</h3>
        </div>
      </div>
    </section>
    <!-- Kategori Section End -->

    <!-- Momen Section Start -->
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
    <!-- Momen Section End -->

    <!-- Footer Start -->
    <footer>
      <div class="social">
        <a href=""><i data-feather="instagram"></i></a>
        <a href=""><i data-feather="twitter"></i></a>
        <a href=""><i data-feather="facebook"></i></a>
      </div>

      <div class="links">
        <a href="#home">Home</a>
        <a href="#kategori">Kategori</a>
        <a href="#momen">Momen</a>
      </div>

      <div class="credit">
        <p>Created by <a href="">Raditya A.W</a>. | &copy; 2023.</p>
      </div>
    </footer>
    <!-- Footer End -->

    <!-- Feather-Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="{{ asset('js\script.js') }}"></script>
    
    <script>
      var msg = '{{Session::get('success')}}';
      var exist = '{{Session::has('success')}}';
      if(exist){
        alert(msg);
      }
    </script>
    <script>
      let dropdowncontent = document.getElementById("dropdowncontent");

      function toggleMenu() {
        dropdowncontent.classList.toggle("open")
      }

    </script>
  </body>
</html>
