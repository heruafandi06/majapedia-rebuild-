@extends('template')

@section('content')
<title>Majapedia | Tambah Alamat </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      <a href="{{ route('profil') }}">Profil Saya</a> /
      <a href="{{ route('daftar-alamat') }}">Daftar Alamat</a> /
      Tambah Alamat
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
                        <h5>Tambah Alamat</h5>
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
                              <label for="jenis_alamat" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Alamat') }}</label>

                              <div class="col-md-6">
                                  <input id="jenis_alamat" type="text" class="form-control @error('jenis_alamat') is-invalid @enderror" name="jenis_alamat" value="{{ old('jenis_alamat') }}" required autocomplete="jenis_alamat" autofocus placeholder="Contoh: Alamat rumah, kantor, dsb.">

                                  @error('jenis_alamat')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="provinsi" class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>

                              <div class="col-md-6">
                                  <select id="provinsi" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" required autocomplete="provinsi" onchange="pilih_kota(this.value);">
                                      <option value="">Pilih Provinsi</option>
                                      @foreach ($provinsi as $provinsi)
                                      <option value="{{ $provinsi->province_id }}">{{ $provinsi->province }}</option>
                                      @endforeach
                                  </select>

                                  @error('provinsi')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <script type="text/javascript">
                            function pilih_kota(provinsi)
                            {
                              // alert(provinsi);
                              $.ajax({
                                url:"{{ route(('pilih-kota'), Auth::user()->username) }}",
                                type:"PUT",
                								data:{
                                  "_token":"{{ csrf_token() }}",
                                  "provinsi":provinsi
                                },
                                success:function(data){
                									$("#kota").html(data);
                								}
                							});
                            }
                          </script>

                          <div class="form-group row">
                              <label for="kota" class="col-md-4 col-form-label text-md-right">{{ __('Kota') }}</label>

                              <div class="col-md-6">
                                  <select id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" required autocomplete="kota">
                                      <option value="">Pilih Kota</option>
                                  </select>

                                  @error('kota')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="kode_pos" class="col-md-4 col-form-label text-md-right">{{ __('Kode Pos') }}</label>

                              <div class="col-md-6">
                                  <input id="kode_pos" type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}" required autocomplete="kode_pos">

                                  @error('kode_pos')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="alamat_lengkap" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Lengkap') }}</label>

                              <div class="col-md-6">
                                  <textarea id="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" required autocomplete="alamat_lengkap"></textarea>

                                  @error('alamat_lengkap')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-danger">
                                      {{ __('Simpan') }}
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
