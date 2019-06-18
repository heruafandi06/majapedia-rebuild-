@extends('template')

@section('content')
<title>Majapedia | Keranjang Belanja </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      Keranjang Belanja
    </div>
  </div>
</div>
<section class="top-letest-product-section">
  <div class="container">
      <div class="row">
          <div class="@if($countkeranjang !== 0) col-md-8 @else col-md-12 @endif">
              <div class="card mb-3">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->

                  <div class="card-body">
                      <div class="section-title">
                        <h5>Keranjang Belanja</h5>
                      </div>
                      @if ($message = Session::get('hapus'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      @if ($message = Session::get('ubah'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                      </div>
                      @endif
                      <!-- <div id="hasil"></div> -->
                      @if($countkeranjang === 0)
                      <p>Keranjang belanja Anda kosong, &nbsp;<a href="{{ route('home') }}">belanja sekarang</a>!</p>
                      @else
                      <div class="table-responsive">
                        <table class="table">
        									<thead class="thead-dark">
        										<tr>
        											<th>Produk</th>
        											<th>Harga</th>
        											<th>Jumlah</th>
        											<th>Sub Total</th>
        											<th></th>
        										</tr>
        									</thead>
                            @php
                              $total = 0;
                            @endphp
                            <tbody>
                            @foreach ($usahanya as $u)
        										<tr class="table-secondary">
        											<td colspan="5"><h6>Usaha: {{ $u->nama_usaha }}</h6></td>
        										</tr>
                            @foreach ($produknya->where('id_usaha', $u->id_usaha) as $p)
        										<tr>
        											<td>
                                @foreach ($gambarnya->where('id_produk', $p->id_produk) as $g)
                                @endforeach
                                <img src="{{ URL::asset('file/'.$g->url) }}" alt="gbr_produk" width="100" height="100" />
        												<br>{{ $p->nama_produk }}
        											</td>
        											<td>Rp {{ number_format($p->harga_jual, 2) }}</td>
        											<td>
        												<form method="post" action="{{ route('ubah-keranjang') }}">
                                  @csrf
        												  <div class="form-group">
                                    <div class="quantity">
                                      <input type="hidden" id="id_produk" name="id_produk" value="{{ $p->id_produk }}" />
                                      <div class="quantity">
                                        <div class="pro-qty mr-3">
                                          <input type="text" id="jumlah" name="jumlah" value="{{ $p->jumlah }}">
                                        </div>
                                        <button type="submit" title="Refresh" style="background: none; border: none; color: #155724; cursor: pointer; padding: 0px;"><i class="fa fa-refresh"></i></button>
                                      </div>
                                    </div>
        												  </div>
        												</form>
        											</td>
                              @php
                                $subtotal = $p->harga_jual*$p->jumlah;
                              @endphp
        											<td>Rp {{ number_format($subtotal, 2) }}</td>
        											<td>
        												<form method="post" action="{{ route('hapus-keranjang') }}">
                                  @csrf
        													<input type="hidden" name="id_produk" value="{{ $p->id_produk }}" />
        													<button onclick="return confirm('Hapus produk {{ $p->nama_produk }}?')" type="submit" title="Hapus" style="background: none; border: none; color: #fe4c50; cursor: pointer; padding: 0px;"><i class="fa fa-trash"></i></button>
        												</form>
        											</td>
                              @php
                                $total += $subtotal;
                              @endphp
        										</tr>
                            @endforeach
                            @endforeach
        										</tbody>
        								</table>
                      </div>
                      @endif
                      <!-- <script type="text/javascript">
                          function test(id_produk, jumlah){
                            $.ajax({
                              type : 'POST',
                              url : "{{ route('ubah-keranjang') }}",
                              data :  {
                                        "_token":"{{ csrf_token() }}",
                                        'id_produk':id_produk,
                                        'jumlah':jumlah
                                      },
                              success: function (data) {
                                $("#hasil").html(data);
                              }
                            });
                          }
                      </script> -->
                  </div>
              </div>
          </div>
          @if($countkeranjang !== 0)
          <div class="col-md-4">
              <div class="card">
                  <div class="card-body">
                    <div class="section-title">
                      <h5>Ringkasan Belanja</h5>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Total ({{ $countkeranjang }} produk):</td>
                          <td>Rp {{ number_format($total, 2) }}</td>
                        </tr>
                        <tr>
                          <td>
                            <a href="{{ route('home') }}"><button type="button" class="btn btn-dark">Lanjut Belanja</button></a>
                          </td>
                          <td>
                            <a href="{{ route('buat-pesanan') }}"><button type="button" class="btn btn-danger">Buat Pesanan</button></a>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
          @endif
      </div>
  </div>
</section>
@endsection
