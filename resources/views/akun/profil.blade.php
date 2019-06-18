@extends('template')

@section('content')
<title>Majapedia | Profil Saya </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      Profil Saya
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
                <li class="list-group-item bg-secondary"><a href="{{ route('profil') }}" style="color:white;">Profil Saya</a></li>
                <li class="list-group-item"><a href="{{ route('daftar-alamat') }}" style="color:black;">Daftar Alamat</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-9">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Profil Saya</h5>
                      </div>
                      @if ($message = Session::get('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      <form method="POST" action="">
                          @csrf

                          <!-- <i class="flaticon-gear"></i> Ubah -->
                          <div class="form-group row">
                              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                              <div class="col-md-6">
                                  <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                                  @error('username')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="nama_user" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                              <div class="col-md-6">
                                  <input id="nama_user" type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{ $user->nama_user }}" required autocomplete="nama_user">

                                  @error('nama_user')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                              <div class="col-md-6">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                  @error('email')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="telp" class="col-md-4 col-form-label text-md-right">{{ __('No. Handphone') }}</label>

                              <div class="col-md-6">
                                  <input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ $user->telp }}" required autocomplete="telp">

                                  @error('telp')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-danger">
                                      {{ __('Perbarui') }}
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
