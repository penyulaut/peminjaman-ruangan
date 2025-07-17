@extends('dashboard.layouts.main')

@section('container')
<div class="card shadow mb-4">
  <div class="card-body">

    {{-- Alert Section --}}
    @if(session()->has('roomSuccess'))
      <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        {{ session('roomSuccess') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session()->has('deleteRoom'))
      <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
        {{ session('deleteRoom') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    {{-- Top Buttons --}}
    <div class="d-flex flex-wrap justify-content-end gap-2 mb-3">
      @if (auth()->user()->role_id <= 3)
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamRuangan">
          Pinjam
        </button>
      @endif
      @if (auth()->user()->role_id == 1)
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoom">
          Tambah Ruangan
        </button>
      @endif
    </div>

    {{-- Table Card --}}
    <div class="card mt-3">
      <div class="card-body">
        <h5 class="card-title">Data Ruangan</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-light text-center">
              <tr>
                <th>No.</th>
                <th>Foto Ruangan</th>
                <th>Nama Ruangan</th>
                <th>Kode Ruangan</th>
                <th>Kapasitas</th>
                @if(auth()->user()->role_id == 1)
                  <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($rooms as $room)
              <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>
                @if($room->img)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $room->img) }}" 
                        alt="Preview" 
                        class="img-thumbnail" 
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
                @endif
                </td>
                <td class="text-center">
                  <a href="/dashboard/rooms/{{ $room->kode }}" class="text-decoration-none">{{ $room->nama }}</a>
                </td>
                <td >{{ $room->kode }}</td>
                <td>{{ $room->kapasitas }}</td>

                @if (auth()->user()->role_id <= 2)
                <td>
                  <div class="d-flex justify-content-center gap-1">
                  @if(auth()->user()->role_id == 1)
                    {{-- Edit Button --}}
                    <a href="#"
                      class="btn btn-sm btn-outline-warning"
                      id="editroom"
                      data-id="{{ $room->id }}"
                      data-kode="{{ $room->kode }}"
                      data-bs-toggle="modal"
                      data-bs-target="#editRoom{{ $room->id }}">
                      <i class="mdi mdi-pencil-outline"></i>
                    </a>


                    {{-- Delete Button --}}
                    <form action="/dashboard/rooms/{{ $room->kode }}" method="POST" onsubmit="return confirm('Hapus data ruangan?')">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="mdi mdi-delete-outline"></i>
                      </button>
                    </form>                                      
                  @endif
                  <!-- Modal Ruangan -->
                  <!-- Modal Ruangan -->
                  <div class="modal fade" id="editRoom{{ $room->id }}" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <form action="{{ route('dashboard.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  @method('PUT')
                                  <div class="modal-header">
                                      <h5 class="modal-title">Edit Ruangan</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="mb-3">
                                          <label for="kode{{ $room->id }}" class="form-label" >Kode Ruangan</label>
                                          <input type="text" class="form-control @error('kode') is-invalid @enderror" 
                                                name="kode" id="kode{{ $room->id }}" 
                                                value="{{ $room->kode }}" required>
                                          @error('kode')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                      </div>
                                      <div class="mb-3">
                                          <label for="nama{{ $room->id }}" class="form-label">Nama Ruangan</label>
                                          <input type="text" class="form-control" 
                                                name="nama" id="nama{{ $room->id }}" 
                                                value="{{ $room->nama }}" required>
                                      </div>
                                      <<div class="mb-3">
                                          <label for="img{{ $room->id }}" class="form-label">Foto Ruangan</label>
                                          
                                          <!-- Tampilkan preview gambar lama -->
                                          @if($room->img)
                                          <div class="mb-2">
                                              <img src="{{ asset('storage/' . $room->img) }}" 
                                                  alt="Preview" 
                                                  class="img-thumbnail" 
                                                  style="width: 200px; height: 100px; object-fit: cover; border-radius: 8px;">
                                          </div>
                                          @endif
                                          
                                          <!-- Input file -->
                                          <input type="file" class="form-control @error('img') is-invalid @enderror" 
                                                name="img" id="img{{ $room->id }}">
                                          
                                          @error('img')
                                              <div class="invalid-feedback">
                                                  {{ $message }}
                                              </div>
                                          @enderror
                                          
                                          <!-- Info text -->
                                      </div>
                                      <div class="mb-3 row">
                                          <div class="col-6">
                                              <label for="lantai{{ $room->id }}" class="form-label">Lantai</label>
                                              <input type="number" class="form-control" 
                                                    name="lantai" id="lantai{{ $room->id }}" 
                                                    value="{{ $room->lantai }}" required>
                                          </div>
                                          <div class="col-6">
                                              <label for="kapasitas{{ $room->id }}" class="form-label">Kapasitas</label>
                                              <input type="number" class="form-control" 
                                                    name="kapasitas" id="kapasitas{{ $room->id }}" 
                                                    value="{{ $room->kapasitas }}" required>
                                          </div>
                                      </div>
                                      <div class="mb-3">
                                          <label for="tipe{{ $room->id }}" class="form-label d-block">Tipe Ruangan</label>
                                          <select class="form-select" name="tipe" id="tipe{{ $room->id }}" required>
                                              <option disabled>Pilih Tipe Ruangan</option>
                                              @foreach(['Laboratorium', 'Ruang Kelas', 'Ruang Dosen', 'Ruang Umum', 'Auditorium'] as $type)
                                                  <option value="{{ $type }}" {{ $room->tipe == $type ? 'selected' : '' }}>
                                                      {{ $type }}
                                                  </option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="mb-3">
                                          <label for="deskripsi{{ $room->id }}" class="form-label">Deskripsi</label>
                                          <textarea class="form-control" name="deskripsi" id="deskripsi{{ $room->id }}" 
                                                    rows="3" required>{{ $room->deskripsi }}</textarea>
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
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $rooms->links() }}
        </div>
      </div>
    </div>

  </div>
</div>

{{-- Modal Includes --}}
@include('dashboard.partials.rentModal')
@include('dashboard.partials.addRoomModal')
@include('dashboard.partials.editRoomModal')

@endsection
