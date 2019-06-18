<link rel="stylesheet" href="{{ asset('css/ganti-warna.css') }}"/>
<style>
    /* The container <div> - needed to position the dropdown content */
  .dropdown {
  position: relative;
  display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
  display: none;
  position: absolute;
  margin-top: 10px;
  background-color: #f1f1f1;
  min-width: 175px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 2;
  }

  /* Links inside the dropdown */
  .dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  }

  /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
  .show {display:block;}
</style>
  <!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="{{ route('index') }}" class="site-logo">
							<!-- <img src="img/logo.png" alt=""> -->
              <h3>Majapedia</h3>
						</a>
					</div>
					<div class="col-xl-5 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Cari di Majapedia ....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-5 col-lg-5">
						<div class="user-panel">
              <div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
                  @if(!empty($countkeranjang))
									<span>
                    {{ $countkeranjang }}
                  </span>
                  @endif
								</div>
								<a href="{{ route('keranjang') }}">Cart</a>
							</div>
              @if(Auth::user())
              <div class="up-item" style="margin-right:20px;">
								<i class="flaticon-store"></i>
                <div class="dropdown">
                  <a onclick="usahaDropdown()" class="dropbtn" href="#">Usaha</a>
                  @if(empty($punyausaha))
                  <div id="usahaDropdown" class="dropdown-content">
                    <a href="{{ route('mulai-usaha') }}">
                      <button type="button" name="button" class="btn btn-danger">Memulai Usaha!</button>
                    </a>
                  </div>
                  @else
                  <div id="usahaDropdown" class="dropdown-content">
                    <div class="d-flex p-2 border-bottom">
                      <img src="{{ URL::asset('file/'.$punyausaha->logo_usaha) }}" class="rounded-circle mt-2" width="40px" height="40px">
                      <a href="{{ route('profil-usaha') }}">
                        {{ $punyausaha->nama_usaha }}
                      </a>
                      @if($punyausaha->status_usaha==1)
                        <i class="fa fa-check-circle mt-3" style="color:#007bff;"></i>
                      @endif
                    </div>
                    @if($punyausaha->status_usaha==1)
                    <a href="{{ route('tambah-produk') }}">Tambah Produk</a>
                    <a href="">Pesanan</a>
                    @endif
                  </div>
                  @endif
                </div>
              </div>
              @endif
							<div class="up-item">
								<i class="flaticon-profile"></i>
                @if(Auth::user())
                <div class="dropdown">
                  <a onclick="akunDropdown()" class="dropbtn" href="#">{{ Auth::user()->nama_user }}</a>
                  <div id="akunDropdown" class="dropdown-content">
                    <a href="{{ route('profil') }}">Profil</a>
                    <a href="#">Pesanan Saya</a>
                    <a href="#">Lacak Pesanan</a>
                    <hr>
                    <a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                  </div>
                </div>
                @else
                <a href="{{ route('login') }}">Masuk</a> atau <a href="{{ route('register') }}">Daftar Akun</a>
                @endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->
  <script>
  /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
  function akunDropdown() {
    document.getElementById("akunDropdown").classList.toggle("show");
    document.getElementById("usahaDropdown").classList.remove("show");
  }

  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

  function usahaDropdown() {
    document.getElementById("usahaDropdown").classList.toggle("show");
    document.getElementById("akunDropdown").classList.remove("show");
  }

  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  </script>
