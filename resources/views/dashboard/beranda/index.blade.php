@extends('dashboard.layouts.main')

@section('container')
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Beranda
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                  <a href="{{ route('export.pdf') }}" class="btn btn-danger" target="_blank">
                      <i class="mdi mdi-file-pdf"></i> Export PDF
                  </a>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Ruangan <i class="mdi mdi-chart-line mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $roomCount }}</h2>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Pengguna <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $userCount }}</h2>
                  </div>
                </div>
              </div>
            
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Peminjaman <i class="mdi mdi-diamond mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $rentCount }}</h2>
                  </div>
                </div>
              </div>
            
              <!-- <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Jurusan <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i></h4>
                    <h2 class="mb-5">{{ $majorCount }}</h2>
                  </div>
                </div>
              </div> -->
            </div>
            
            <div class="row">
              <h3 class="mb-4">Kalender Peminjaman</h3>

              <div id="calendar">
            </div>                      
@endsection