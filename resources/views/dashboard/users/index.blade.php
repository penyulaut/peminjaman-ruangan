@extends('dashboard.layouts.main')

@section('container')
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Admin<i class="mdi mdi-chart-line mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $adminCount }}</h2>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Mahasiswa<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $mahasiswaCount }}</h2>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Dosen<i class="mdi mdi-diamond mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $dosenCount }}</h2>
                  </div>
                </div>
              </div>                        
            </div>


  {{-- Flash Message --}}
  @if(session()->has('userSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('userSuccess') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session()->has('deleteUser'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('deleteUser') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- Tambah User --}}
  <div class="card shadow">    
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
      		<i class="bi bi-plus-circle"></i> Tambah User
    	    </button>
        </div>

      {{-- Table --}} 
             
          <div class="card mt-4">
              <h5 class="card-title">Daftar Pengguna</h5>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>No</th>
                      <th>Username</th>
                      <th>NIM</th>
                      <th>Email</th>
                      <th>Jurusan</th>
                      <!-- <th>No HP</th> -->
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nim }}</td>
                        <td>{{ $user->email }}</td>                      
                        <td>{{ $user->jurusan }}</td>                      
                        <td>
                      @if ($user->role_id == 1)
                          Admin
                      @elseif ($user->role_id == 2)
                          Dosen
                      @elseif ($user->role_id == 3)
                          Mahasiswa
                      @else
                          Tidak Diketahui
                      @endif
                  </td>            
                        <td>                        
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" 
                                class="text-success me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#edituser{{ $user->id }}">
                                <i class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil-fill"></i></i>
                            </a>
                            <a href="/dashboard/users/{{ $user->id }}/makeAdmin" class="btn btn-sm btn-outline-info me-1">
                              <i class="bi bi-person-plus-fill"></i>
                            </a>
                            <form action="/dashboard/users/{{ $user->id }}" method="post" onsubmit="return confirm('Hapus data user?')">
                              @csrf
                              @method('delete')
                              <button type="submit" class="btn btn-sm btn-outline-danger me-1">
                                <i class="bi bi-trash-fill"></i>
                              </button>
                            </form>
                          </div>

                            <!-- Modal edit -->
                            <div class="modal fade" id="edituser{{ $user->id }}" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dashboard.users.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="name" id="name{{ $user->id }}" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nim{{ $user->id }}" class="form-label">NIM</label>
                                                    <input type="number" class="form-control" name="nim" id="nim{{ $user->id }}" value="{{ $user->nim }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jurusan{{ $user->id }}" class="form-label">Jurusan</label>
                                                    <input type="text" class="form-control" name="jurusan" id="jurusan{{ $user->id }}" value="{{ $user->jurusan }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" id="email{{ $user->id }}" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                  <label for="role_id" class="form-label d-block">User Role</label>                    
                                                  <select class="form-select text-dark" name="role_id" id="role_id" required>
                                                      <option disabled {{ is_null($user->role_id) ? 'selected' : '' }}>Pilih Role</option>
                                                      @foreach ($roles as $role)
                                                          <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                              {{ $role->role_name }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach                   
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                  </tbody>
                </table>
              </div>
          </div>

      {{-- Pagination --}}
      <div class="d-flex justify-content-end mt-3">
        {{ $users->links() }}
      </div>
    </div>
</div>

    {{-- Modal --}}
    @include('dashboard.partials.addUserModal')
    @include('dashboard.partials.editUserModal')
    @endsection
