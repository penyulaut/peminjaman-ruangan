<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SITEPAR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="{{ asset('assets/images/icon-sitepar.png') }}" />

  <style>
    body {
      scroll-behavior: smooth;
      font-family: 'Poppins', sans-serif;
    }
    .hero {
      background: url('images/Rektorat_Untirta_Sindangsari.jpg') no-repeat center center/cover;
      height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background-color: rgba(255, 255, 255, 0.8); /* semi-transparent white */
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-heading {
    font-weight: 700;
    color: #6f42c1; /* ungu Bootstrap */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
  }

    .hero-sub {
        font-weight: 500;
        font-size: 1.25rem;
        color: #555;
    }

    .btn-cta {
        background-color: #d63384;
        color: white;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        transition: background 0.3s ease;
    }

    .btn-cta:hover {
        background-color: #c22574;
        color: #fff;
    }
    .about-icon {
        font-size: 3rem;
         color: #0d6efd;
        margin-bottom: 1rem;
    }

    .room-card img {
         height: 200px;
        object-fit: cover;
        width: 100%;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .contact-bubble {
        width: 70px;
        height: 70px;
         border-radius: 50%;
        background-color: #6f42c1; /* ungu tua */
         color: white;
        display: flex;
        align-items: center;
       justify-content: center;
       transition: transform 0.2s ease;
    }
    .contact-bubble:hover {
       transform: scale(1.1);
      background-color: #b68df1; /* ungu sedang */
    }
</style>

  </style>
</head>
<body>

<!-- Navbar -->
@include('partials.navbarnew')

@yield('container')

<!-- Footer -->
<footer class="text-center py-3" style="background-color: #eadaff; color: #2c2c2c;">
  <p class="mb-0">© 2025 Kelompok 1. All rights reserved.</p>
</footer>

<!-- Login & Register Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border rounded shadow">
      
      <!-- Alert kalau login error -->
      @if(session()->has('loginError'))
      <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      
      <div class="modal-header">
        <h5 class="modal-title" id="authModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
  <!-- LOGIN FORM -->
  <form action="{{ route('login') }}" method="post" id="loginForm">
    @csrf
    <p class="text-muted">Masuk ke akun yang sudah terdaftar</p>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input 
        type="email" 
        name="email"
        class="form-control @error('email') is-invalid @enderror" 
        id="email" 
        placeholder="Masukkan email"
        value="{{ old('email') }}" 
        required
        autofocus
      >
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>    

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input 
        type="password" 
        name="password"
        class="form-control @error('password') is-invalid @enderror" 
        id="password" 
        placeholder="Masukkan password"
        required
      >
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn w-100 text-white" style="background-color: #6f42c1;">Login</button>
    
    <div class="text-center mt-3">
      <small>Belum punya akun? <a href="#" id="showRegister">Register</a></small>
    </div>
  </form>

  <!-- REGISTER FORM -->
  <form action="{{ route('register') }}" method="post" id="registerForm" class="d-none">
    @csrf
    <p class="text-muted">Buat akun baru untuk mengakses sistem</p>  

    <div class="mb-3">
      <label for="regName" class="form-label">Nama Lengkap</label>
      <input 
        type="text" 
        name="name" 
        class="form-control @error('name') is-invalid @enderror" 
        id="regName" 
        placeholder="Masukkan nama lengkap" 
        value="{{ old('name') }}" 
        required
      >
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="regEmail" class="form-label">Email</label>
      <input 
        type="email" 
        name="email" 
        class="form-control @error('email') is-invalid @enderror" 
        id="regEmail" 
        placeholder="Masukkan email" 
        value="{{ old('email') }}" 
        required
      >
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
    <label for="nim" class="form-label">NIM</label>
    <input 
      type="text" 
      name="nim"
      class="form-control @error('nim') is-invalid @enderror" 
      id="nim" 
      placeholder="Masukkan NIM"
      value="{{ old('nim') }}" 
      required
    >
    @error('nim')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="jurusan" class="form-label">Jurusan</label>
    <input 
      type="text" 
      name="jurusan"
      class="form-control @error('jurusan') is-invalid @enderror" 
      id="jurusan" 
      placeholder="Masukkan jurusan"
      value="{{ old('jurusan') }}" 
      required
    >
    @error('jurusan')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="no_hp" class="form-label">No HP</label>
    <input 
      type="text" 
      name="no_hp"
      class="form-control @error('no_hp') is-invalid @enderror" 
      id="no_hp" 
      placeholder="Masukkan no HP"
      value="{{ old('no_hp') }}" 
      required
    >
    @error('no_hp')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>

    <div class="mb-3">
      <label for="role" class="form-label">Pilih Role</label>
      <select 
        name="role" 
        class="form-control @error('role') is-invalid @enderror" 
        id="role" 
        required
      >
        <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
      </select>
      @error('role')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="regPassword" class="form-label">Password</label>
      <input 
        type="password" 
        name="password" 
        class="form-control @error('password') is-invalid @enderror" 
        id="regPassword" 
        placeholder="Masukkan password" 
        required
      >
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="regConfirmPassword" class="form-label">Konfirmasi Password</label>
      <input 
        type="password" 
        name="password_confirmation" 
        class="form-control @error('password_confirmation') is-invalid @enderror" 
        id="regConfirmPassword" 
        placeholder="Konfirmasi password" 
        required
      >
      @error('password_confirmation')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <button type="submit" class="btn w-100 text-white" style="background-color: #6f42c1;">Register</button>
    
    <div class="text-center mt-3">
      <small>Sudah punya akun? <a href="#" id="showLogin">Login</a></small>
    </div>
</form>

</div>

      
    </div>
  </div>
</div>

  <script>
    const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const modalTitle = document.getElementById("authModalLabel");
  
    showRegister.addEventListener("click", function (e) {
      e.preventDefault();
      loginForm.classList.add("d-none");
      registerForm.classList.remove("d-none");
      modalTitle.textContent = "Register";
    });
  
    showLogin.addEventListener("click", function (e) {
      e.preventDefault();
      registerForm.classList.add("d-none");
      loginForm.classList.remove("d-none");
      modalTitle.textContent = "Login";
    });
  </script>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
