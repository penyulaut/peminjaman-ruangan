<!-- Start Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top pt-3">
  <div class="container-fluid">
    <!-- Logo Brand -->
    <a class="navbar-brand d-flex align-items-center" href="/">
            @if (substr_count(URL::current(), '/') == 5)
            <img src='{{Request::is('dashboard') ? '' : '../../'}}img/logotext.png' alt='LOGO' width="150" />
            @else
            <img src='{{Request::is('dashboard') ? '' : '../'}}img/logotext.png' alt='LOGO' width="150"/>    
            @endif
    </a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Content -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active fw-bold' : '' }}" href="/">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active fw-bold' : '' }}" href="/about">Tentang</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('help') ? 'active fw-bold' : '' }}" href="/help">Bantuan</a>
        </li>
      </ul>

      <!-- Right Side -->
      <ul class="navbar-nav mb-2 mb-lg-0">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('img/default-profile.png') }}" alt="Profile" class="rounded-circle me-2" width="32" height="32">
            <span>{{ auth()->user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
            <li>
              <a class="dropdown-item" href="/dashboard/rooms"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link btn btn-outline-primary ms-2" href="/login">Login</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
