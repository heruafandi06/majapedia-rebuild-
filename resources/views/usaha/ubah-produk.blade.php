@extends('template')

@section('content')
<title>Majapedia | Ubah Produk </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/purify.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/LANG.js"></script>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      <a href="{{ route('profil-usaha') }}">Profil Usaha</a> /
      <a href="{{ route('daftar-produk') }}">Daftar Produk</a> /
      Ubah Produk
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
                <li class="list-group-item"><a href="{{ route('profil-usaha') }}" style="color:black;">Profil Usaha</a></li>
                <li class="list-group-item bg-secondary"><a href="{{ route('daftar-produk') }}" style="color:white;">Daftar Produk</a></li>
                <li class="list-group-item"><a href="" style="color:black;">Statistik Penjualan</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-9">
              <div class="card">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Ubah Produk</h5>
                      </div>
                      <form method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group">
                              <label for="kv-explorer" class="col-md-4 col-form-label text-md-left">{{ __('Gambar Produk') }}</label>
                              <div class="file-loading">
                                <input type="file" name="file[]" id="kv-explorer" multiple>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-md-4">
                                  <input id="id_usaha" type="hidden" class="form-control @error('id_usaha') is-invalid @enderror" name="id_usaha" required autocomplete="id_usaha" value="{{ $punyausaha->id }}">

                                  @error('id_usaha')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="nama_produk" class="col-md-4 col-form-label text-md-left">{{ __('Nama Produk') }}</label>

                              <div class="col-md-4">
                                  <input id="nama_produk" type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" required autocomplete="nama_produk" value="{{ $produk->nama_produk }}">

                                  @error('nama_produk')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="kategori" class="col-md-4 col-form-label text-md-left">{{ __('Kategori Produk') }}</label>

                              <div class="col-md-4">
                                  <select id="kategori" class="form-control @error('kategori') is-invalid @enderror" name="kategori" required autocomplete="kategori">
                                      <option value="{{ $produk->kategori['id'] }}">{{ $produk->kategori['nama_kategori'] }}</option>
                                      @foreach ($kategori as $kategori)
                                      <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                      @endforeach
                                  </select>

                                  @error('kategori')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="harga" class="col-md-4 col-form-label text-md-left">{{ __('Harga') }}</label>

                              <div class="col-md-4">
                                  <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" required autocomplete="harga" value="{{ $produk->harga }}">

                                  @error('harga')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="stok" class="col-md-4 col-form-label text-md-left">{{ __('Stok') }}</label>

                              <div class="col-md-2">
                                  <input id="stok" type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" required autocomplete="stok" value="{{ $produk->stok }}">

                                  @error('stok')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="berat" class="col-md-4 col-form-label text-md-left">{{ __('Berat') }}</label>

                              <div class="col-md-2">
                                  <input id="berat" type="text" class="form-control @error('berat') is-invalid @enderror" name="berat" required autocomplete="berat" value="{{ $produk->berat }}">

                                  @error('berat')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="deskripsi" class="col-md-4 col-form-label text-md-left">{{ __('Deskripsi') }}</label>

                              <div class="col-md-6">
                                  <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required autocomplete="deskripsi" rows="4">
                                       {{ $produk->deskripsi_produk }}
                                  </textarea>

                                  @error('deskripsi')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="form-group mb-0">
                              <div class="col-md-6">
                                  <button type="submit" name="submit" value="ubah" class="btn btn-danger">
                                      {{ __('Perbarui') }}
                                  </button>
                              </div>
                          </div>
                      </form>
                      <script type="text/javascript">
                          $("#kv-explorer").fileinput({
                              'theme': 'fas',
                              'uploadUrl': "",
                              uploadExtraData:function(){
                                return{
                                  _token:$("input[name='_token']").val()
                                };
                              },
                              overwriteInitial: false,
                              initialPreviewAsData: true,
                              showUpload:false,
                              showRemove:false,
                              maxFileCount: 5,
                              maxFileSize: 1000,
                              allowedFileExtensions: ['jpg', 'png', 'jpeg'],
                              // browseOnZoneClick:true,
                              initialPreview: [
                                  @foreach($gambarproduk as $gambarproduk)
                                  "{{ URL::asset('file/'.$gambarproduk->url) }}",
                                  @endforeach
                              ],
                              initialPreviewConfig: [
                                  @foreach($gambarproduk2 as $gambarproduk2)
                                  {
                                    caption: "{{ $gambarproduk2->url }}",
                                     size: "", width: "120px",
                                     url: "{{ route(('hapus-gambar'), $gambarproduk2->id) }}",
                                     key: "{{ $gambarproduk2->id }}"
                                  },
                                  @endforeach
                              ]
                          });
                      </script>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
