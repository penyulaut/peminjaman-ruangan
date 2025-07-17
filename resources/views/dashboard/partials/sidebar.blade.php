

        <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link" >
                <div class="nav-profile-image">
                  <img src="{{asset('assets/images/faces/profil.png')}}" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
                  <span class="text-secondary text-small">
                    @if(auth()->user()->role_id == 1)
                        Admin
                    @elseif(auth()->user()->role_id == 2)
                        Dosen
                    @elseif(auth()->user()->role_id == 3)
                        Mahasiswa
                    @else
                        Tidak diketahui
                    @endif
                </span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" {{ Request::is('dashboard/beranda') ? 'active-link' : 'text-dark' }}" href="/dashboard/beranda">
                <span class="menu-title">Beranda</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>                       

            <li class="nav-item">
              <a class="nav-link" {{ Request::is('dashboard/rents') ? 'active-link' : 'text-dark' }}" href="/dashboard/rents">
                <span class="menu-title">Riwayat Peminjaman</span>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
            </li>                         

            <li class="nav-item">
              <a class="nav-link" {{ Request::is('dashboard/rooms') ? 'active-link' : 'text-dark' }}" href="/dashboard/rooms">
                <span class="menu-title">Data Ruangan</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>

            @if (auth()->user()->role_id == 1)
            <li class="nav-item">
              <a class="nav-link" {{ Request::is('dashboard/users') ? 'active-link' : 'text-dark' }}" href="/dashboard/users">
                <span class="menu-title">Pengguna</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li> 
            
            <li class="nav-item">
              <a class="nav-link" {{ Request::is('dashboard/admin') ? 'active-link' : 'text-dark' }}" href="{{route ('dashboard.admin')}}">
                <span class="menu-title">Daftar Admin</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>   
            @endif         
        </ul>