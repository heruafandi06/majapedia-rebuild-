@extends('template')
@section('content')
<title>Majapedia | Home </title>
<body>
  <!-- Page Preloder -->
  <div id="preloder">
  	<div class="loader"></div>
  </div>

  <!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="{{ asset('img/bg.jpg') }}">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>New Arrivals</span>
							<h2>denim jackets</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2>$29</h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="{{ asset('img/bg-2.jpg') }}">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<span>New Arrivals</span>
							<h2>denim jackets</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
							<a href="#" class="site-btn sb-line">DISCOVER</a>
							<a href="#" class="site-btn sb-white">ADD TO CART</a>
						</div>
					</div>
					<div class="offer-card text-white">
						<span>from</span>
						<h2>$29</h2>
						<p>SHOP NOW</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Features section -->
	<section class="features-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{ asset('img/icons/1.png') }}" alt="#">
						</div>
						<h2>Fast Secure Payments</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{ asset('img/icons/2.png') }}" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="{{ asset('img/icons/3.png') }}" alt="#">
						</div>
						<h2>Free & fast Delivery</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->

	<!-- letest product section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>PRODUK TERBARU</h2>
			</div>
			<div class="product-slider owl-carousel">
          @foreach ($produk as $produk)
          <form class="" action="{{ route('keranjang') }}" method="post">
            @csrf
            <input type="hidden" name="id_produk" value="{{ $produk->id }}">
            <input type="hidden" name="jumlah" value="1">
            <input type="hidden" name="harga" value="{{ $produk->harga }}">
            <div class="product-item">
  						<div class="pi-pic">
  							<a href="{{ route(('detil-produk'), [$produk->slug_produk, $produk->id]) }}">
                  <img src="{{ URL::asset('file/'.$produk->gambar->url) }}" alt="" width="500px" height="250px">
                </a>
  							<div class="pi-links">
                    <button type="submit" style="background-color:transparent;border:none;cursor:pointer;">
                      <a class="add-card">
                        <i class="flaticon-bag"></i><span>Beli</span>
                      </a>
                    </button>
  								<!-- <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a> -->
  							</div>
  						</div>
  						<div class="pi-text">
                <a href=""><p class="border-bottom mb-2"><i class="flaticon-store"></i> {{ $produk->usaha->nama_usaha }}</p></a>
                <h6>Rp {{ number_format($produk->harga, 2) }}</h6>
                <a href="{{ route(('detil-produk'), [$produk->slug_produk, $produk->id]) }}"><p>{{ $produk->nama_produk }}</p></a>
  						</div>
  					</div>
          </form>
          @endforeach
			</div>
		</div>
	</section>
	<!-- letest product section end -->

	<!-- Product filter section -->
	<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>BROWSE TOP SELLING PRODUCTS</h2>
			</div>
			<ul class="product-filter-menu">
				<li><a href="#">TOPS</a></li>
				<li><a href="#">JUMPSUITS</a></li>
				<li><a href="#">LINGERIE</a></li>
				<li><a href="#">JEANS</a></li>
				<li><a href="#">DRESSES</a></li>
				<li><a href="#">COATS</a></li>
				<li><a href="#">JUMPERS</a></li>
				<li><a href="#">LEGGINGS</a></li>
			</ul>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
							<img src="{{ asset('img/product/12.jpg') }}" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<!-- <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a> -->
							</div>
						</div>
						<div class="pi-text">
							<h6>$35,00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center pt-5">
				<button class="site-btn sb-line sb-dark">LOAD MORE</button>
			</div>
		</div>
	</section>
	<!-- Product filter section end -->


	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
			<div class="banner set-bg" data-setbg="{{ asset('img/banner-bg.jpg') }}">
				<div class="tag-new">NEW</div>
				<span>New Arrivals</span>
				<h2>STRIPED SHIRTS</h2>
				<a href="#" class="site-btn">SHOP NOW</a>
			</div>
		</div>
	</section>
	<!-- Banner section end  -->

</body>
@endsection
