@extends('template')

@section('content')
<title>Majapedia | Daftar Produk </title>
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
      Daftar Produk
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
                        <h5>Daftar Produk</h5>
                      </div>
                      @if ($message = Session::get('message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                      @endif
                      <a href="{{ route('tambah-produk') }}">
                        <button type="button" class="btn btn-sm btn-dark mb-3">
                          <i class="fa fa-plus-circle"></i> Tambah Produk
                        </button>
                      </a>
                      <div class="row">
                        @forelse ($produksaya as $produksaya)
                				<div class="col-lg-3 col-sm-6">
                					<div class="product-item">
                						<div class="pi-pic">
                							<img src="{{ URL::asset('file/'.$produksaya->gambar->url) }}" alt="" width="500px" height="250px">
                							<div class="pi-links">
                								<a href="{{ route(('ubah-produk'), $produksaya->id) }}" class="whistlist-btn"><i class="fa fa-pencil-alt"></i></a>
                								<a href="{{ route(('hapus-produk'), $produksaya->id) }}" class="whistlist-btn"><i class="fa fa-trash"></i></a>
                							</div>
                						</div>
                						<div class="pi-text">
                              <p>{{ $produksaya->nama_produk }}</p>
                              <!-- <p>{{ $produksaya->usaha->nama_usaha }}</p> -->
                							<p>Rp {{ number_format($produksaya->harga, 2) }}</p>
                						</div>
                					</div>
                				</div>
                        @empty
                        <p style="text-indent: 15px;">Belum ada produk yang ditambahkan, &nbsp;<a href="{{ route('tambah-produk') }}">tambah produk baru</a>.</p>
                        @endforelse
                			</div>

                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection
