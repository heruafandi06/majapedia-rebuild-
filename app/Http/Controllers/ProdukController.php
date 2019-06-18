<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\GambarProduk;
use App\Usaha;
use App\Keranjang;
use Auth;

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
}
