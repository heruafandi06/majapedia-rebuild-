@extends('template')

@section('content')
<title>Majapedia | Daftar Alamat </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      <a href="{{ route('profil') }}">Profil Saya</a> /
      Daftar Alamat
    </div>
  </div>
</div>
<section class="top-letest-product-section">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-3">
            <div class="card mb-3">
              <div class="card-header bg-dark">
                <h6 style="color:white;">Menu</h6>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="{{ route('profil') }}" style="color:black;">Profil Saya</a></li>
                <li class="list-group-item bg-secondary"><a href="{{ route('daftar-alamat') }}" style="color:white;">Daftar Alamat</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-9">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Daftar Alamat</h5>
                      </div>
                      @if ($message = Session::get('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      <a href="{{ route('alamat') }}">
                        <button type="button" class="btn btn-sm btn-dark mb-3">
                          <i class="fa fa-plus-circle"></i> Tambah Alamat
                        </button>
                      </a>
                      <div class="row">
                        @forelse ($alamat as $alamat)
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-header bg-dark">
                              <h6 style="color:white; float:left;">{{ $alamat->jenis_alamat }}</h6>
                              <a onclick="return confirm('Hapus alamat {{ $alamat->jenis_alamat }}?')" href="{{ route('hapus-alamat', $alamat->id) }}">
                                <h6 style="color:white; float:right;"><i class="fa fa-trash"></i></h6>
                              </a>
                            </div>
                            <div class="card-body">
                              <p class="card-text">{{ $alamat->alamat }}, {{ $alamat->kabupaten->city_name }}</p>
                              <p class="card-text">{{ $alamat->provinsi->province }}, {{ $alamat->kode_pos }}</p>
                              <a href="{{ route(('ubah-alamat'), $alamat->id) }}" class="btn btn-sm btn-danger">Ubah</a>
                            </div>
                          </div>
                        </div>
                        @empty
                        <p style="text-indent: 15px;">Belum ada alamat yang ditambahkan, &nbsp;<a href="{{ route('alamat') }}">tambah alamat baru</a>.</p>
                        @endforelse
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
