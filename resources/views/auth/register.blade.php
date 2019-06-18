@extends('template')

@section('content')
<title>Majapedia | Daftar </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<section class="top-letest-product-section">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Sudah punya akun majapedia? <br>Login <a href="{{ route('login') }}">di sini</a></h5>
                      </div>
                      <form method="POST" action="{{ route('register') }}">
                          @csrf

                          <div class="form-group row">
                              <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                              <div class="col-md-6">
                                  <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

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
                                  <input id="nama_user" type="text" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user" value="{{ old('nama_user') }}" required autocomplete="nama_user">

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
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                  <input id="telp" type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required autocomplete="telp">

                                  @error('telp')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                              <div class="col-md-6">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>

                              <div class="col-md-6">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-danger">
                                      {{ __('Daftar') }}
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
