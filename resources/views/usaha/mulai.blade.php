@extends('template')

@section('content')
<title>Majapedia | Mulai Usaha </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<section class="top-letest-product-section">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Login') }}</div> -->

                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <h5 class="text-center">Informasi Usaha</h5><hr>
                        <div class="form-group row">
                            <label for="nama_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Nama Usaha') }}</label>

                            <div class="col-md-6">
                                <input id="nama_usaha" type="text" class="form-control @error('nama_usaha') is-invalid @enderror" name="nama_usaha" value="{{ old('nama_usaha') }}" required autocomplete="nama_usaha" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Logo Usaha') }}</label>

                            <div class="col-md-6">
                                <input id="logo_usaha" type="file" class="form-control @error('logo_usaha') is-invalid @enderror" name="logo_usaha" value="{{ old('logo_usaha') }}" required autocomplete="logo_usaha">

                                @error('logo_usaha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deskripsi_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi Usaha') }}</label>

                            <div class="col-md-6">
                                <textarea id="deskripsi_usaha" class="form-control @error('deskripsi_usaha') is-invalid @enderror" name="deskripsi_usaha" required autocomplete="deskripsi_usaha"></textarea>

                                @error('deskripsi_usaha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto_ktp" class="col-md-4 col-form-label text-md-right">{{ __('Foto KTP') }}</label>

                            <div class="col-md-6">
                                <input id="foto_ktp" type="file" class="form-control @error('foto_ktp') is-invalid @enderror" name="foto_ktp" value="{{ old('foto_ktp') }}" required autocomplete="foto_ktp">

                                @error('foto_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto_dengan_ktp" class="col-md-4 col-form-label text-md-right">{{ __('Foto dengan KTP') }}</label>

                            <div class="col-md-6">
                                <input id="foto_dengan_ktp" type="file" class="form-control @error('foto_dengan_ktp') is-invalid @enderror" name="foto_dengan_ktp" value="{{ old('foto_dengan_ktp') }}" required autocomplete="foto_dengan_ktp">

                                @error('foto_dengan_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="siup" class="col-md-4 col-form-label text-md-right">{{ __('Surat Izin Usaha') }}</label>

                            <div class="col-md-6">
                                <input id="siup" type="file" class="form-control @error('siup') is-invalid @enderror" name="siup" value="{{ old('siup') }}" required autocomplete="siup">

                                @error('siup')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr><h5 class="text-center">Lokasi Usaha</h5><hr>
                        <div class="form-group row">
                            <label for="provinsi" class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>

                            <div class="col-md-6">
                                <select id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" required autocomplete="provinsi" onchange="pilih_kota(this.value);">
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
                            <label for="alamat_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Usaha') }}</label>

                            <div class="col-md-6">
                                <textarea id="alamat_usaha" class="form-control @error('alamat_usaha') is-invalid @enderror" name="alamat_usaha" required autocomplete="alamat_usaha"></textarea>

                                @error('alamat_usaha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Mulai') }}
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
