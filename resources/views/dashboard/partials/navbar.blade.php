<!-- Start Navbar -->
<!-- <header class="header d-flex justify-content-center">
    <div class="header_content d-flex flex-row align-items-center">
      <a href="#">
        <div class="logo_container">
          <div class="logo">
            @if (substr_count(URL::current(), '/') == 5)
            <img src='{{Request::is('dashboard') ? '' : '../../'}}img/logotext.png' alt='LOGO' />
            @else
            <img src='{{Request::is('dashboard') ? '' : '../'}}img/logotext.png' alt='LOGO' />    
            @endif  
          </div>
        </div>
      </a>
      <div class="main_nav_container">
        <div class="main_nav">
          <ul class="main_nav_list">
            <li class="main_nav_item {{Request::is('') ? '' : 'active'}}">
              <a href="/">Beranda</a>
            </li>
            <li class="main_nav_item {{Request::is('about') ? 'active' : ''}}">
              <a href="/about">Tentang</a>
            </li>
            <li class="main_nav_item {{Request::is('help') ? 'active' : ''}}">
              <a href="/help">Bantuan</a>
            </li>
            @auth
            <li class="main_nav_item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="text-dark">{{auth()->user()->name}} &#9660;</span> 
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/dashboard/rooms"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                  </form>  
              </ul>
            </li>
            @else
            <li class="main_nav_item {{Request::is('login') ? 'active' : ''}}">
              <a href="/login">Login</a>
            </li>
            @endauth
          </ul>
        </div>
      </div>
  </header> -->
  <!-- End Navbar -->



      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo" href="index.html"><img src="{{asset('assets/images/logo-sitepar.svg')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo-sitepar-mini.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>          
          <ul class="navbar-nav navbar-nav-right">
            @auth
            <li class="nav-item nav-profile main_nav_item dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{asset('assets/images/faces/profil.png')}}" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <span class="text-dark">{{auth()->user()->name}}</span> 
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="/">
                  <i class="mdi mdi-cached me-2 text-success"></i>Beranda</a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                      @csrf
                      <button type="submit" class="dropdown-item"><i class="mdi mdi-logout me-2 text-primary"></i> Logout</button>
                </form>  
              </div>
            </li>
            @else
            <li class="main_nav_item {{Request::is('login') ? 'active' : ''}}">
              <a href="/login">Login</a>
            </li>
            @endauth           
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>                