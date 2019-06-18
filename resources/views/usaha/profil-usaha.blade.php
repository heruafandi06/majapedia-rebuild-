@extends('template')

@section('content')
<title>Majapedia | Profil Usaha </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      Profil Usaha
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
                <li class="list-group-item bg-secondary"><a href="{{ route('profil-usaha') }}" style="color:white;">Profil Usaha</a></li>
                @if($punyausaha->status_usaha == 1)
                <li class="list-group-item"><a href="{{ route('daftar-produk') }}" style="color:black;">Daftar Produk</a></li>
                <li class="list-group-item"><a href="" style="color:black;">Statistik Penjualan</a></li>
                @endif
              </ul>
            </div>
          </div>
          <div class="col-md-9">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Profil Usaha</h5>
                      </div>
                      @if ($message = Session::get('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif

                      @if ($message = Session::get('gagal'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      <form method="POST" action="">
                          @csrf

                          <center><img src="{{ URL::asset('file/'.$usahasaya->logo_usaha) }}" alt="logo_usaha" width="100px" height="100px" class="rounded-circle mb-3"></center>

                          <div class="form-group row">
                              <label for="nama_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Nama Usaha') }}</label>

                              <div class="col-md-6">
                                  <input id="nama_usaha" type="text" class="form-control @error('nama_usaha') is-invalid @enderror" name="nama_usaha" value="{{ $usahasaya->nama_usaha }}" required autocomplete="nama_usaha" autofocus>

                                  @error('nama_usaha')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="deskripsi_usaha" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi Usaha') }}</label>

                              <div class="col-md-6">
                                  <textarea id="deskripsi_usaha" class="form-control @error('deskripsi_usaha') is-invalid @enderror" name="deskripsi_usaha" required autocomplete="deskripsi_usaha">
                                      {{ $usahasaya->deskripsi_usaha }}
                                  </textarea>

                                  @error('deskripsi_usaha')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <!--
                          <div class="form-group row">
                              <label for="foto_ktp" class="col-md-4 col-form-label text-md-right">{{ __('Foto KTP') }}</label>

                              <div class="col-md-6">
                                  <input id="foto_ktp" type="file" class="form-control @error('foto_ktp') is-invalid @enderror" name="foto_ktp" required autocomplete="foto_ktp" style="display:none;">

                                  @error('foto_ktp')
                                  <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                  </span>
                                  @enderror

                                  <img src="{{ URL::asset('file/'.$usahasaya->foto_ktp) }}" width="100px;" id="fktp"><br>
                                  <input type="checkbox" name="checkktp" value="1" onclick="javascript: if(this.checked==true){
                                    document.getElementById('fktp').style.display='none';document.getElementById('foto_ktp').style.display='block';
                                  }else{
                                    document.getElementById('fktp').style.display='block';document.getElementById('foto_ktp').style.display='none';
                                  }">
                                  Ubah foto KTP?
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="foto_dengan_ktp" class="col-md-4 col-form-label text-md-right">{{ __('Foto dengan KTP') }}</label>

                              <div class="col-md-6">
                                  <input id="foto_dengan_ktp" type="file" class="form-control @error('foto_dengan_ktp') is-invalid @enderror" name="foto_dengan_ktp" value="{{ old('foto_dengan_ktp') }}" required autocomplete="foto_dengan_ktp" style="display:none;">

                                  @error('foto_dengan_ktp')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                                  <img src="{{ URL::asset('file/'.$usahasaya->foto_dengan_ktp) }}" width="100px;" id="fdktp"><br>
                                  <input type="checkbox" name="checkdktp" value="1" onclick="javascript: if(this.checked==true){
                                    document.getElementById('fdktp').style.display='none';document.getElementById('foto_dengan_ktp').style.display='block';
                                  }else{
                                    document.getElementById('fdktp').style.display='block';document.getElementById('foto_dengan_ktp').style.display='none';
                                  }">
                                  Ubah foto dengan KTP?
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="siup" class="col-md-4 col-form-label text-md-right">{{ __('Surat Izin Usaha') }}</label>

                              <div class="col-md-6">
                                  <input id="siup" type="file" class="form-control @error('siup') is-invalid @enderror" name="siup" value="{{ old('siup') }}" required autocomplete="siup" style="display:none;">

                                  @error('siup')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                                  <img src="{{ URL::asset('file/'.$usahasaya->siup) }}" width="100px;" id="fsiup"><br>
                                  <input type="checkbox" name="checksiup" value="1" onclick="javascript: if(this.checked==true){
                                    document.getElementById('fsiup').style.display='none';document.getElementById('siup').style.display='block';
                                  }else{
                                    document.getElementById('fsiup').style.display='block';document.getElementById('siup').style.display='none';
                                  }">
                                  Ubah foto Surat Izin Usaha?
                              </div>
                          </div>
                          -->

                          <hr><h5 class="text-center">Lokasi Usaha</h5><hr>
                          <div class="form-group row">
                              <label for="provinsi" class="col-md-4 col-form-label text-md-right">{{ __('Provinsi') }}</label>

                              <div class="col-md-6">
                                  <select id="provinsi" type="text" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi" required autocomplete="provinsi" onchange="pilih_kota(this.value);">
                                      <option value="{{ $usahasaya->provinsi['province_id'] }}">{{ $usahasaya->provinsi['province'] }}</option>
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
                                      <option value="{{ $usahasaya->kabupaten['city_id'] }}">{{ $usahasaya->kabupaten['city_name'] }}</option>
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
                                  <input id="kode_pos" type="text" class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ $usahasaya->kode_pos }}" required autocomplete="kode_pos">

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
                                  <textarea id="alamat_usaha" class="form-control @error('alamat_usaha') is-invalid @enderror" name="alamat_usaha" required autocomplete="alamat_usaha">
                                      {{ $usahasaya->alamat_usaha }}
                                  </textarea>

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
