<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\GambarProduk;
use App\KategoriProduk;
use App\Usaha;
use App\Keranjang;
use Auth;
use Illuminate\Support\Facades\Input;

class ProdukController extends Controller
{
    public function index($slug, $id)
    {
        $gambaractive = GambarProduk::where('id_produk', $id)->firstOrFail();
        $gambarproduk = GambarProduk::where('id_produk', $id)
                                    ->where('id', '!=', $gambaractive->id)
                                    ->get();
        if(Auth::user()){
            $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
            $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                    ->get();
            $countkeranjang = count($keranjangku);
            if(!empty($punyausaha)){
              $produk = Produk::where('id_usaha', '!=', $punyausaha->id)
                              ->where('id', $id)
                              ->where('slug_produk', $slug)
                              ->firstorFail();
              return view('detil-produk', compact('punyausaha', 'produk', 'gambarproduk', 'gambaractive', 'countkeranjang'));
            }else{
              $produk = Produk::where('id', $id)
                              ->where('slug_produk', $slug)
                              ->firstorFail();
              return view('detil-produk', compact('produk', 'gambarproduk', 'gambaractive', 'countkeranjang'));
            }
        }else{
            $produk = Produk::where('id', $id)
                            ->firstorFail();
            return view('detil-produk', compact('produk', 'gambarproduk', 'gambaractive'));
        }
    }

    public function semuaproduk(){
        if(Auth::user()){
            $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
            $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                    ->get();
            $countkeranjang = count($keranjangku);
            if(!empty($punyausaha)){
              $produk = Produk::where('id_usaha', '!=', $punyausaha->id)
                              ->where(function($query){
                                      $kategori = Input::has('kategori') ? Input::get('kategori') : [];
                                      if(isset($kategori)){
                                        foreach ($kategori as $k){
                                          $query->orWhere('id_kategori', $k);
                                        }
                                      }
                              })
                              ->orderBy('id', 'DESC')
                              ->get();

              $kategori = KategoriProduk::orderBy('nama_kategori', 'ASC')->get();

              return view('semua-produk', compact('punyausaha', 'kategori', 'produk', 'countkeranjang'));
            }else{
              $produk = Produk::orderBy('id', 'DESC')
                              ->where(function($query){
                                $sort = Input::has('sort') ? Input::get('sort') : null;
                                $kategori = Input::has('kategori') ? Input::get('kategori') : [];

                                if(isset($kategori)){
                                  foreach ($kategori as $k){
                                    $query->orWhere('id_kategori', $k);
                                  }
                                }

                                if(isset($sort)){
                                  if($sort == "produk-asc"){
                                    $query->orderBy('nama_produk', 'ASC');
                                  }
                                  else if($sort == "produk-desc"){
                                    $query->orderBy('nama_produk', 'DESC');
                                  }else{
                                    $query->orderBy('id', 'DESC');
                                  }
                                }
                              })
                              ->get();
              $kategori = KategoriProduk::orderBy('nama_kategori', 'ASC')->get();

              return view('semua-produk', compact('produk', 'kategori', 'countkeranjang'));
            }
        }else{
            $produk = Produk::where(function($query){
                              $kategori = Input::has('kategori') ? Input::get('kategori') : [];
                                if(isset($kategori)){
                                  foreach ($kategori as $k){
                                    $query->orWhere('id_kategori', $k);
                                  }
                                }
                              })
                              ->orderBy('id', 'DESC')
                              ->get();
            $kategori = KategoriProduk::orderBy('nama_kategori', 'ASC')->get();
            return view('semua-produk', compact('produk', 'kategori'));
        }
    }
}
