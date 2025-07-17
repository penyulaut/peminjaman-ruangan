<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <!-- Sidebar Start -->
            <li class="nav-item {{Request::is('dashboard/admin') ? 'sidebar-active' : ''}}">
              <a class="nav-link" href="/dashboard/admin">
                <span class="menu-title">Daftar admin</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item {{Request::is('dashboard/rents') ? 'sidebar-active' : ''}}">
              <a class="nav-link" href="/dashboard/rents">
                <span class="menu-title">Daftar Peminjaman</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item {{Request::is('dashboard/rooms') ? 'sidebar-active' : ''}}">
              <a class="nav-link" href="/dashboard/rooms">
                <span class="menu-title">Daftar ruangan</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <!-- Sidebar -->


        </nav>