@extends('template')

@section('content')
<title>Majapedia | Tambah Produk </title>
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
      Tambah Produk
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
                        <h5>Tambah Produk</h5>
                      </div>
                      <form method="POST" enctype="multipart/form-data">
                          @csrf

                          <div class="form-group">
                              <label for="file-1" class="col-md-4 col-form-label text-md-left">{{ __('Gambar Produk') }}</label>
                              <div class="file-loading">
                                <input type="file" name="file[]" id="file-1" multiple class="file" data-overwrite-Initial="false" data-max-File-Size="1000" data-max-Files-Count="5" data-show-Upload="false" data-show-Remove="false" data-browse-On-Zone-Click="true" data-theme="fas">
                              </div>
                          </div>
                          <!-- <div class="form-group row">
                              <label for="gambar_produk" class="col-md-4 col-form-label text-md-right">{{ __('Gambar Produk') }}</label>

                              <div class="col-md-6">
                                <div class="input-group-btn">
                                  <button class="btn btn-primary" type="button"><i class="fa fa-plus-circle"></i> Add</button>
                                  <button type="submit" name="submit" value="upload" class="btn btn-danger">
                                      {{ __('Upload') }}
                                  </button>
                                </div>
                                <div class="input-group control-group increment" >
                                  <input type="file" name="filename[]" class="form-control">
                                </div>
                                <div class="clone" style="display:none;">
                                  <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                      <button class="btn btn-success" type="button"><i class="fa fa-close"></i> Remove</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div> -->

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
                                  <input id="nama_produk" type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" required autocomplete="nama_produk">

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
                                      <option value="">Pilih Kategori</option>
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
                                  <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" required autocomplete="harga">

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
                                  <input id="stok" type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" required autocomplete="stok">

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
                                  <input id="berat" type="text" class="form-control @error('berat') is-invalid @enderror" name="berat" required autocomplete="berat">

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
                                  <button type="submit" name="submit" value="tambah" class="btn btn-danger">
                                      {{ __('Tambah') }}
                                  </button>
                              </div>
                          </div>

                      </form>
                  </div>
                  <!-- <script type="text/javascript">
                  // var tu = document.getElementsByClassName("kv-file-upload").style.display ="none";

                    $("#file-1").fileinput({
                        theme: 'fas',
                        uploadUrl: "{{ route('tambah-produk') }}", // you must set a valid URL here else you will get an error
                        uploadExtraData:function(){
                          return{
                            _token:$("input[name='_token']").val()
                          };
                        },
                        allowedFileExtensions: ['jpg', 'png', 'jpeg'],
                        overwriteInitial: false,
                        maxFileSize: 1000,
                        maxFilesNum: 10,
                        showUpload:false,
                        showRemove:false,
                        browseOnZoneClick:true,
                    });
                  </script> -->
              </div>
          </div>
      </div>
  </div>
</section>
<!-- <script type="text/javascript">

$(document).ready(function() {

  $(".btn-primary").click(function(){
    var html = $(".clone").html();
    $(".increment").after(html);
  });

  $("section").on("click",".btn-success",function(){
    $(this).parents(".control-group").remove();
  });

});

</script> -->
@endsection
