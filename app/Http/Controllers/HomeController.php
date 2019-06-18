<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usaha;
use App\Produk;
use App\Keranjang;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);
        if(!empty($punyausaha)){
            $produk = Produk::where('id_usaha', '!=', $punyausaha->id)
                          ->orderBy('id', 'DESC')->get();
            return view('home', compact('punyausaha', 'produk', 'countkeranjang'));
        }else{
            $produk = Produk::orderBy('id', 'DESC')->get();
            return view('home', compact('produk', 'countkeranjang'));
        }
    }
}
