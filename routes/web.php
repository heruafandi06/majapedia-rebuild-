<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index')->name('index');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes(['verify' => true]);

Route::group(['middleware'=>'auth'], function(){
  //profil
  Route::get('/profil-saya', 'AkunController@profil')->name('profil');
  Route::post('/profil-saya', 'AkunController@updateprofil');
  Route::get('/daftar-alamat', 'AkunController@daftaralamat')->name('daftar-alamat');
  Route::get('/tambah-alamat', 'AkunController@alamat')->name('alamat');
  Route::post('tambah-alamat', 'AkunController@tambahalamat');
  Route::get('/ubah-alamat/{id}', 'AkunController@ubahalamat')->name('ubah-alamat');
  Route::post('/ubah-alamat/{id}', 'AkunController@postubahalamat');
  Route::get('/hapus-alamat/{id}', 'AkunController@hapusalamat')->name('hapus-alamat');
  Route::put('/tambah-alamat', 'ProvinsiController@pilihkota')->name('pilih-kota');
});

Route::group(['middleware'=>'verified'], function(){
  //profil usaha
  Route::get('/mulai-usaha', 'UsahaController@index')->name('mulai-usaha');
  Route::post('/mulai-usaha', 'UsahaController@bukausaha');
  Route::get('/profil-usaha', 'UsahaController@profilusaha')->name('profil-usaha');
  Route::post('/profil-usaha', 'UsahaController@updateprofil');
  Route::get('/daftar-produk', 'UsahaController@daftarproduk')->name('daftar-produk');
  Route::get('/tambah-produk', 'UsahaController@tambahproduk')->name('tambah-produk');
  Route::post('/tambah-produk', 'UsahaController@tambahprodukpost');
  Route::get('/ubah-produk/{id}', 'UsahaController@ubahproduk')->name('ubah-produk');
  Route::post('/ubah-produk/{id}', 'UsahaController@ubahprodukpost');
  Route::post('/hapus-gambar/{id}', 'UsahaController@hapusgambar')->name('hapus-gambar');
  Route::get('/hapus-produk/{id}', 'UsahaController@hapusproduk')->name('hapus-produk');

  //keranjang
  Route::get('/keranjang', 'keranjangController@index')->name('keranjang');
  Route::post('/keranjang', 'keranjangController@keranjangpost');
  Route::post('/hapuskeranjang', 'keranjangController@hapus')->name('hapus-keranjang');
  Route::post('/ubahkeranjang', 'keranjangController@ubah')->name('ubah-keranjang');
  Route::get('/pengiriman', 'keranjangController@buatpesanan')->name('buat-pesanan');
  Route::post('/pengiriman', 'keranjangController@buatpesanan');
  Route::post('/cekongkir', 'keranjangController@cekongkir')->name('cek-ongkir');
  Route::post('/checkout', 'checkoutController@index')->name('checkoutpost');
  Route::get('/checkout/{id}', 'checkoutController@checkout')->name('checkout');
});

Route::get('/produk/{slug}/{id}', 'ProdukController@index')->name('detil-produk');
Route::get('/semua-produk', 'ProdukController@semuaproduk')->name('semua-produk');
