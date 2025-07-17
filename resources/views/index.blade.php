@extends('layouts.main')

@section('container')
<!-- Home Section -->
<section id="home" class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h1 class="hero-heading display-4">Selamat Datang Di SITEPAR</h1>
            <p class="hero-sub mt-3">Sistem Informasi Tempat Peminjaman Ruangan</p>
            <p class="hero-sub">Temukan Dan Pinjam Ruangan dengan mudah dan cepat di SITEPAR</p>
            <a href="#about" class="btn btn-cta mt-4">GET STARTED</a>
        </div>
    </section>

<!-- About Us Section -->
<section id="about" class="py-5">
  <div class="container text-center">
    <h2 class="mb-4">Mengapa Pilih Kami?</h2>
    <div class="row align-items-center">
      <div class="col-md-3">
        <div class="about-icon"><i class="fas fa-bolt"></i></div>
        <h5>Peminjaman Cepat</h5>
        <p>Proses peminjaman ruangan dalam hitungan menit</p>
      </div>
      <div class="col-md-3">
        <div class="about-icon"><i class="fa-solid fa-list-check"></i></i></div>
        <h5>Manajemen Mudah</h5>
        <p>Kelola data ruangan dan user dengan mudah</p>
      </div>
      <div class="col-md-3">
        <div class="about-icon"><i class="fa-solid fa-chart-simple"></i></div>
        <h5>Laporan Lengkap</h5>
        <p>Akses laporan peminjaman secara komprehensif</p>
      </div>
      <div class="col-md-3">
        <div class="about-icon"><i class="fas fa-headset"></i></div>
        <h5>Akses Multi-Level</h5>
        <p>Hak akses berbeda untuk mahasiswa, dosen, dan admin</p>
      </div>
    </div>
  </div>
</section>

<!-- Rooms Section -->
<section class="py-5 bg-light" id="ruangan">
    <div class="container">
      <h2 class="text-center fw-bold mb-5">Ruangan</h2>
      <div class="row g-4">
  
        <div class="col-md-3">
            <div class="card room-card">
                <img src="images/ruang1.jpg" alt="Ruang 1">
                <div class="card-body">
                  <h5 class="card-title text-primary fw-bold">Ruang 1</h5>
                  <p class="card-text">Deskripsi singkat Ruang 1 yang menjelaskan fungsinya secara umum.</p>
                </div>
              </div>              
        </div>
  
        <div class="col-md-3">
            <div class="card room-card">
                <img src="images/ruang2.jpg" alt="Ruang 1">
                <div class="card-body">
                  <h5 class="card-title text-primary fw-bold">Ruang 2</h5>
                  <p class="card-text">Deskripsi singkat Ruang 2 yang menjelaskan fungsinya secara umum.</p>
                </div>
              </div>
        </div>
  
        <div class="col-md-3">
            <div class="card room-card">
                <img src="images/ruang3.jpg" alt="Ruang 1">
                <div class="card-body">
                  <h5 class="card-title text-primary fw-bold">Ruang 3</h5>
                  <p class="card-text">Deskripsi singkat Ruang 3 yang menjelaskan fungsinya secara umum.</p>
                </div>
              </div>              
        </div>

        <div class="col-md-3">
            <div class="card room-card">
                <img src="images/ruang4.jpg" alt="Ruang 1">
                <div class="card-body">
                  <h5 class="card-title text-primary fw-bold">Ruang 4</h5>
                  <p class="card-text">Deskripsi singkat Ruang 4 yang menjelaskan fungsinya secara umum.</p>
                </div>
              </div>              
          </div>
      </div>
    </div>
  </section>
  
 <!-- Contact Us Section -->
<section id= "contact" class="contact-us py-5" style="background-color: #f3e8ff;">
  <div class="container text-center">
    <h2 class="mb-2 text-dark">Contact Us</h2>
    <p class="mb-4 text-muted">Kontak kami jika ada pertanyaan!</p>

    <div class="row justify-content-center">

      <!-- Email -->
      <div class="col-12 col-md-4 mb-4">
        <div class="contact-bubble mx-auto mb-2">
          <i class="bi bi-envelope-fill fs-2"></i>
        </div>
        <p><a class="text-decoration-none text-dark">contoh@untirta.ac.id</a></p>
      </div>

      <!-- Phone -->
      <div class="col-12 col-md-4 mb-4">
        <div class="contact-bubble mx-auto mb-2">
          <i class="bi bi-telephone-fill fs-2"></i>
        </div>
        <p><a class="text-decoration-none text-dark">+62 875-7534-3244</a></p>
        <p><a class="text-decoration-none text-dark">+62 895-7732-8431</a></p>
      </div>

      <!-- Location -->
      <div class="col-12 col-md-4 mb-4">
        <div class="contact-bubble mx-auto mb-2">
          <i class="bi bi-geo-alt-fill fs-2"></i>
        </div>
        <p class="text-dark">223J+FR8, Jl. Jenderal Sudirman Km 3, Kotabumi, Kec. Purwakarta, Kota Cilegon, Banten 42435</p>
      </div>

    </div>
  </div>
</section>
@endsection