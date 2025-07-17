                    
@extends('dashboard.layouts.main')

@section('container')
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar {{ $title }}</h6>
                        </div>
                        <div class="card-body">
                            
                        <div class="d-flex flex-wrap justify-content-end mb-3 gap-2">
                            <a href="/dashboard/users" class="btn btn-outline-primary shadow-sm">
                                <i class="bi bi-people"></i> Pilih dari User
                            </a>
                            <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAdmin">
                                <i class="bi bi-plus-circle"></i> Tambah Data Baru
                            </button>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="table-info">
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nomor Induk</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>                                    
                                    <tbody>
                                        @foreach($admins as $admin) 
                                        <tr>                                            
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->nomor_induk }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>
                                                <a href="/dashboard/users/{{ $admin->id }}/edit" 
                                                class="btn btn-sm btn-warning" 
                                                data-id="{{ $admin->id }}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#edituser">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="/dashboard/admin/{{ $admin->id }}/removeAdmin" 
                                                class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Ubah admin menjadi mahasiswa?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @extends('dashboard.partials.addAdminModal')
@extends('dashboard.partials.editUserModal')
{{-- @extends('dashboard.partials.chooseAdminModal') --}}
@endsection



@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid px-3">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-md-12">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-primary text-white text-center rounded-top-4">
                    <h4 class="mb-0">Daftar {{ $title }}</h4>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-end mb-3 gap-2">
                        <a href="/dashboard/users" class="btn btn-outline-primary shadow-sm">
                            <i class="bi bi-people"></i> Pilih dari User
                        </a>
                        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAdmin">
                            <i class="bi bi-plus-circle"></i> Tambah Data Baru
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered text-center align-middle" id="datatable">
                            <thead class="table-info">
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Nomor Induk</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->nomor_induk }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <a href="/dashboard/users/{{ $admin->id }}/edit" 
                                           class="btn btn-sm btn-warning" 
                                           data-id="{{ $admin->id }}" 
                                           data-bs-toggle="modal" 
                                           data-bs-target="#edituser">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="/dashboard/admin/{{ $admin->id }}/removeAdmin" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Ubah admin menjadi mahasiswa?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- table responsive -->
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</div> <!-- container -->

@extends('dashboard.partials.addAdminModal')
@extends('dashboard.partials.editUserModal')
{{-- @extends('dashboard.partials.chooseAdminModal') --}}
@endsection

