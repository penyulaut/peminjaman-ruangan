@extends('dashboard.layouts.main')

@section('container')


@if(session()->has('adminSuccess'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('adminSuccess') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  @if(session()->has('deleteAdmin'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('deleteAdmin') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

<div class="card shadow mb-4">    
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-end gap-2">
            <a href="/dashboard/users" class="btn btn-outline-primary shadow-sm">
                <i class="bi bi-people"></i> Pilih dari User
            </a>
            <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAdmin">
                <i class="bi bi-plus-circle"></i> Tambah Data Baru
            </button>
        </div>


        <div class="card mt-2">
            <div class="card-body">
              <h5 class="card-title">Daftar Admin</h5>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nomor Induk</th>
                        <th>Email</th>
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
                      <td>                        
                        <a href="#" 
                            class="text-success me-2 edituser"
                            data-id="{{ $user->id }}"
                            data-bs-toggle="modal"
                            data-bs-target="#edituser{{ $user->id }}"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Edit Admin">
                            <i class="mdi mdi-pencil-outline"></i>
                        </a>
                        <a href="/dashboard/admin/{{ $user->id }}/removeAdmin" 
                            class="text-danger"
                            onclick="return confirm('Ubah admin menjadi mahasiswa?')"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Hapus Hak Admin">
                            <i class="mdi mdi-delete-outline"></i>
                        </a>

                        <div class="modal fade" id="edituser{{ $user->id }}" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dashboard.admin.update', $user->id) }}" method="POST">
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
        </div>
    </div>
</div>


@extends('dashboard.partials.addAdminModal')
@extends('dashboard.partials.editUserModal')
{{-- @extends('dashboard.partials.chooseAdminModal') --}}
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection
