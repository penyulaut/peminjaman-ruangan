@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10 p-4 bg-white rounded shadow-sm">

            <h2 class="text-center mb-4 fw-bold text-primary">{{ $room->name }}</h2>

            <div class="row g-4 mb-4 align-items-start">
                <div class="col-md-4 text-center">
                @if($room->img)
                    <img src="{{ Storage::url($room->img) }}" 
                        alt="{{ $room->nama }}"
                        class="img-fluid rounded shadow"
                        style="max-width: 100%; height: auto;">
                @endif                
                </div>
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tbody>
                            <tr><th scope="row">Nama</th><td>: {{ $room->nama }}</td></tr>
                            <tr><th scope="row">Kode Ruangan</th><td>: {{ $room->kode }}</td></tr>
                            <tr><th scope="row">Lantai</th><td>: {{ $room->lantai }}</td></tr>
                            <tr><th scope="row">Kapasitas</th><td>: {{ $room->kapasitas }}</td></tr>
                            <tr><th scope="row">Tipe Ruangan</th><td>: {{ $room->tipe }}</td></tr>
                            <tr><th scope="row">Deskripsi</th><td>: {{ $room->deskripsi }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-primary mb-0">Daftar Peminjaman</h4>
                @if (auth()->user()->role_id <= 4)
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pinjamRuangan">
                        <i class="bi bi-plus-circle"></i> Pinjam
                    </button>
                @endif
            </div>

            <div class="row align-items-end mb-3">
                <div class="col-md-6">
                    <label for="datePicker" class="form-label fw-bold">Filter Tanggal</label>
                    <div class="d-flex gap-2">
                        <input type="date" class="form-control" id="datePicker" style="max-width: 200px;">
                        <button class="btn btn-primary" id="datebtn">Filter</button>
                        <button class="btn btn-secondary" id="datereset">Reset</button>
                    </div>
                </div>
            </div>

            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Pengguna</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peminjam</th>
                                    <th>Mulai Pinjam</th>
                                    <th>Selesai Pinjam</th>
                                    <th>Tujuan</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="rent-details text-center">
                                @forelse ($rents as $rent)
                                    <tr class="rent-detail">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rent->user->name }}</td>
                                        <td>{{ $rent->time_start_use }}</td>
                                        <td>{{ $rent->time_end_use }}</td>
                                        <td>{{ $rent->purpose }}</td>
                                        <td>{{ $rent->transaction_start }}</td>
                                        <td>
                                            <span class="badge bg-{{ $rent->status === 'dipinjam' ? 'success' : ($rent->status === 'ditolak' ? 'danger' : 'warning') }}">
                                                {{ $rent->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-muted">Belum ada data peminjaman.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('dashboard.partials.rentModal')
@endsection
