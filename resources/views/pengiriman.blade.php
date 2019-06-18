@extends('template')

@section('content')
<title>Majapedia | Pengiriman </title>
<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<div class="page-top-info">
  <div class="container">
    <h4>Halaman</h4>
    <div class="site-pagination">
      <a href="{{ route('index') }}">Home</a> /
      <a href="{{ route('keranjang') }}">Keranjang Belanja</a> /
      Pengiriman
    </div>
  </div>
</div>
<section class="top-letest-product-section">
  <div class="container">
      <div class="row">
          <div class="col-md-8">
              <div class="card mb-3">
                  <!-- <div class="card-header">{{ __('Register') }}</div> -->
                  <div class="card-body">
                      <div class="section-title">
                        <h5>Alamat Pengririman</h5>
                      </div>
                      @if(!empty($alamatsaya))
                      {{ $alamatsaya->alamat }}, {{ $alamatsaya->kabupaten->city_name }} <span class="badge badge-danger">{{ $alamatsaya->jenis_alamat }}</span>
                      <br>
                      {{ $alamatsaya->kode_pos }}, {{ $alamatsaya->provinsi->province }}

                      <br>
                      <button type="button" class="btn btn-sm btn-danger mt-3" data-toggle="modal" data-target="#exampleModal">
                        Pilih alamat lain
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Daftar Alamat</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                              @foreach ($semuaalamat as $semuaalamat)
                              <div class="col-md-6">
                                <div class="card">
                                  <div class="card-body">
                                    <form class="" action="" method="post">
                                      @csrf
                                    {{ $semuaalamat->alamat }}, {{ $semuaalamat->kabupaten->city_name }}, {{ $semuaalamat->kode_pos }}, {{ $semuaalamat->provinsi->province }} <span class="badge badge-danger">{{ $semuaalamat->jenis_alamat }}</span>
                                    <hr>
                                      <input type="hidden" name="id_almt" value="{{ $semuaalamat->id }}">
                                      <button type="submit" name="pilih" value="pilih" class="btn btn-sm btn-danger">Pilih</button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      @else
                      Daftar alamat Anda kosong, &nbsp;<a href="{{ route('alamat') }}">tambah alamat</a>!
                      @endif
                  </div>
                  <hr>
                  <div class="card-body">
                      <div class="section-title">
                        <h5>Ringkasan Pesanan</h5>
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
                            <tr>
                              <td colspan="5" align="right">
                                <form method="post" action="{{ route('hapus-keranjang') }}">
                                  @csrf
                                  <select class="form-control" name="kurir" id="kurir" onChange="cekongkir('{{ $alamatsaya->id_kota }}', '{{ $u->id_kota }}', this.value, '{{ $u->id }}')">
                                    <option value="">Pilih Pengiriman</option>
        														<option value="jne">JNE Regular</option>
                                  </select>
                                </form>
                              </td>
                            </tr>
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
                      <h5>Ringkasan Pembayaran</h5>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Subtotal ({{ $countkeranjang }} produk):</td>
                          <td id="subtotal" class="float-right">{{ $total }}</td>
                        </tr>
                        @foreach ($usahanya as $u)
                        <tr>
                          <td>Ongkir ({{ $u->nama_usaha }}):</td>
                          <td><span id="{{ $u->id }}" class="float-right"></span></td>
                        </tr>
                        @endforeach
                        <tr>
                          <td>
                            <strong>Total:</strong>
                          </td>
                          <td>
                            <span id="total" class="float-right">{{ $total }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <!-- <a href="{{ route('home') }}"><button type="button" class="btn btn-dark">Lanjut Belanja</button></a> -->
                          </td>
                          <td>
                            <form class="" action="{{ route('checkoutpost') }}" method="post">
                              @csrf
                              @foreach ($usahanya as $u)
                              <input type="hidden" name="id_usaha[]" value="{{ $u->id }}">
                              <input type="hidden" id="ongkir{{ $u->id }}" name="ongkir[]">
                              @endforeach
                              <input type="hidden" name="id_alamat" id="id_alamat" value="{{ $alamatsaya->id }}">
                              <input type="hidden" name="totalpembayaran" id="totalpembayaran">
                              <button type="submit" class="btn btn-danger">Checkout</button>
                            </form>
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
<script type="text/javascript">
  var subtotal = document.getElementById("subtotal").innerText;
  var sub = parseInt(subtotal);
  document.getElementById("subtotal").innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal);

  document.getElementById('total').style.fontWeight = 'bold';
  var total = document.getElementById("total").innerText;
  document.getElementById("total").innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
  function cekongkir(asal, tujuan, kurir, idusaha){
    // alert(asal+" "+tujuan+" "+kurir+" "+idusaha);
    $.ajax({
      	type : 'POST',
    	  url : "/cekongkir",
       	data :  {
                  "_token":"{{ csrf_token() }}",
                  'tujuan' : tujuan,
                  'kurir' : kurir,
                  'asal' : asal
                },
			  success: function (data) {
			        $("#"+idusaha).html(data);
			        var ongkir = document.getElementById(idusaha).innerText;
              var ong = parseInt(ongkir);

              document.getElementById("ongkir"+idusaha).value = ongkir;
			        sub = ong+sub;

              document.getElementById("totalpembayaran").value = sub;
        			document.getElementById("total").innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(sub);
        			document.getElementById(idusaha).innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(ongkir);
			  }
    });
  }
</script>
@endsection
