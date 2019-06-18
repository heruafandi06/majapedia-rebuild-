<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;
use App\Keranjang;
use App\PemesananDetil;
use App\Ongkir;
use Auth;
use Carbon;

class CheckoutController extends Controller
{
    public function index(Request $request){
    	$pemesanan = new Pemesanan;
    	$idp = Carbon\Carbon::now();
		  $idp->setTimezone('Asia/Bangkok');
    	$pemesanan->id = $idp->format('Ymdhis');
    	$pemesanan->id_user = Auth::user()->id;
    	$pemesanan->id_alamat = $request['id_alamat'];
    	$pemesanan->tgl_pemesanan = $idp->format('Y-m-d h:i:s');
    	$pemesanan->total = $request['totalpembayaran'];
    	$pemesanan->save();

    	$keranjang = Keranjang::where('id_user', Auth::user()->id)
    						  ->get();
    	foreach ($keranjang as $k){
    		$pemesanandetil = new PemesananDetil;
    		$pemesanandetil->id_pemesanan = $idp->format('Ymdhis');
    		$pemesanandetil->id_produk = $k->id_produk;
    		$pemesanandetil->jumlah = $k->jumlah;
    		$pemesanandetil->harga_jual = $k->harga_jual;
    		$pemesanandetil->status_pemesanan = 0;
    		$pemesanandetil->save();
    	}

    	$idusaha = $request['id_usaha'];
    	$ongkos = $request['ongkir'];
    	$count = count($idusaha);

    	for($i = 0; $i < $count; $i++){
    		$ongkir = new Ongkir;
    		$ongkir->id_pemesanan = $idp->format('Ymdhis');
    		$ongkir->id_usaha = $idusaha[$i];
    		$ongkir->ongkir = $ongkos[$i];
    		$ongkir->save();
    	}

    	return redirect()->route(('checkout'), $idp->format('Ymdhis'));
    }

    public function checkout($id){
    	$pemesananku = Pemesanan::where('id', $id)
    			 				->where('id_user', Auth::user()->id)
    			 				->firstOrFail();

    	return view('checkout', compact('pemesananku'));
    }
}
