@extends('dashboard.layouts.main')

@section('container')
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Menunggu Persetujuan<i class="mdi mdi-chart-line mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $pendingCount }}</h2>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Disetujui<i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $disetujuiCount }}</h2>
                  </div>
                </div>
              </div>

              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Ditolak<i class="mdi mdi-diamond mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $ditolakCount }}</h2>
                  </div>
                </div>
              </div>                        
            </div>
<!-- Filter -->
<!-- <div class="card mb-4">
@if (auth()->user()->role_id == 1) 
  <div class="card-body">
    <h4>Filter Peminjaman</h4>
    <form method="GET" action="{{ route('rents.index') }}">
      <div class="row g-2">
        <div class="col-md-2">
          <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari nama peminjam">
        </div>
        <div class="col-md-2">
          <select class="form-select" name="status">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="dipinjam" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
          </select>
        </div>
        <div class="col-md-2">
          <input type="date" name="date_start" value="{{ request('date_start') }}" class="form-control">
        </div>
        <div class="col-md-2">
          <input type="date" name="date_end" value="{{ request('date_end') }}" class="form-control">
        </div>
        <div class="col-md-2 text-end">
          <a href="{{ route('rents.index') }}" class="btn btn-secondary">Reset</a>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary">Terapkan</button>
        </div>
      </div>
    </form>
  </div>
  @endif
</div> -->
            

<div class="col-md-15 p-0">
<div class="card-body text-end">
  @if(session()->has('rentSuccess'))
    <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show" style="margin-top: 50px" role="alert">
        {{session('rentSuccess')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if(session()->has('deleteRent'))
    <div class="col-md-16 mx-auto alert alert-success text-center  alert-dismissible fade show" style="margin-top: 50px" role="alert">
        {{session('deleteRent')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
          <div class="card mt-1">
            <div class="card-body">
              @if (auth()->user()->role_id == 1)    
              <button type="button" class="mb-3 btn button btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamRuangan">
                Pinjam
              </button>
                            
              @endif
              <h5 class="card-title text-start mb-3">Peminjaman</h5>
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead class="table-light">
                  <tr>
                    <th scope="row">No.</th>
                    <th scope="row">Kode Ruangan</th>
                    @if (auth()->user()->role_id == 1)
                      <th scope="row">Nama Peminjam</th>              
                    @endif
                    <th scope="row">Mulai Pinjam</th>
                    <th scope="row">Selesai Pinjam</th>
                    <th scope="row">Tujuan</th>
                    <th scope="row">Waktu Transaksi</th>
                    <th scope="row">Kembalikan</th>
                    <!-- @if (auth()->user()->role_id == 1)
                    <th scope="row">Approval</th>
                    @endif -->
                    <th scope="row">Status Pinjam</th>
                    @if (auth()->user()->role_id == 1)
                      <th scope="row">Action</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                      @if (auth()->user()->role_id == 1) {{-- Admin melihat semua data --}}
                          @foreach ($adminRents as $rent)
                              <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td><a href="/dashboard/rooms/{{ $rent->room->kode }}" class="text-decoration-none" role="button">{{ $rent->room->kode }}</a></td>
                                  <td>{{ $rent->user->name }}</td>
                                  <td>{{ $rent->time_start_use }}</td>
                                  <td>{{ $rent->time_end_use }}</td>
                                  <td>{{ $rent->purpose }}</td>
                                  <td>{{ $rent->transaction_start }}</td>

                                  @if ($rent->status == "dipinjam")
                                      <td>
                                          <a href="/dashboard/rents/{{ $rent->id }}/endTransaction" class="btn btn-success" style="padding: 2px 10px">
                                              <i class="bi bi-check fs-5"></i>
                                          </a>
                                      </td>
                                  @else
                                      <td>{{ $rent->transaction_end ?? '-' }}</td>
                                  @endif                            

                                  <td>{{ $rent->status }}</td>
                                  <td>
                                      <form action="/dashboard/rents/{{ $rent->id }}" method="post" class="d-inline">
                                          @method('delete')
                                          @csrf
                                          <button type="submit" class="bi bi-trash-fill text-danger border-0" onclick="return confirm('Hapus data peminjaman?')"></button>
                                      </form>
                                      @if(in_array($rent->status, ['pending', 'ditolak']))
                                          <form action="{{ route('rents.approve', $rent->id) }}" method="POST" class="d-inline">
                                              @csrf
                                              @method('PUT')
                                              <button type="submit" class="btn btn-sm btn-warning sm" onclick="return confirm('Setujui peminjaman ini?')">Approve</button>
                                          </form>
                                      @endif
                                      
                                      @if(in_array($rent->status, ['pending', 'dipinjam', 'ditolak']))
                                          <form action="{{ route('rents.reject', $rent->id) }}" method="POST" style="display:inline;">
                                              @csrf
                                              <button type="submit" class="bi bi-x-circle text-danger border-0" onclick="return confirm('Tolak Peminjaman?')" ></button>
                                          </form>
                                      @endif
                                  </td>
                              </tr>
                          @endforeach
                      @else {{-- Dosen (role_id 2) dan Mahasiswa (role_id 3) hanya melihat data mereka sendiri --}}
                          @foreach ($userRents as $rent)
                              <tr>
                                  <th scope="row">{{ $loop->iteration }}</th>
                                  <td><a href="/dashboard/rooms/{{ $rent->room->kode }}" class="text-decoration-none" role="button">{{ $rent->room->kode }}</a></td>
                                  <td>{{ $rent->time_start_use }}</td>
                                  <td>{{ $rent->time_end_use }}</td>
                                  <td>{{ $rent->purpose }}</td>
                                  <td>{{ $rent->transaction_start }}</td>

                                  @if ($rent->status == "dipinjam")
                                      <td>
                                          <a href="/dashboard/rents/{{ $rent->id }}/endTransaction" class="btn btn-success" style="padding: 2px 10px">
                                              <i class="bi bi-check fs-5"></i>
                                          </a>
                                      </td>
                                  @else
                                      <td>{{ $rent->transaction_end ?? '-' }}</td>
                                  @endif

                                  <td>{{ $rent->status }}</td>
                                  @if(auth()->user()->role_id == 2) {{-- Jika dosen, tampilkan tombol action --}}
                                      <td>
                                          @if(in_array($rent->status, ['pending', 'ditolak']))
                                              <form action="{{ route('rents.approve', $rent->id) }}" method="POST" class="d-inline">
                                                  @csrf
                                                  @method('PUT')
                                                  <button type="submit" class="btn btn-sm btn-warning sm" onclick="return confirm('Setujui peminjaman ini?')">Approve</button>
                                              </form>
                                          @endif
                                          
                                          @if(in_array($rent->status, ['pending', 'dipinjam', 'ditolak']))
                                              <form action="{{ route('rents.reject', $rent->id) }}" method="POST" style="display:inline;">
                                                  @csrf
                                                  <button type="submit" class="bi bi-x-circle text-danger border-0" onclick="return confirm('Tolak Peminjaman?')" ></button>
                                              </form>
                                          @endif
                                      </td>
                                  @endif
                              </tr>
                          @endforeach
                      @endif
                  </tbody>

                </table>
              </div>
            </div>
          </div>
</div>
</div>
@extends('dashboard.partials.rentModal')
@endsection
