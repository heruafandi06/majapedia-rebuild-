<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Keranjang;
use App\Produk;
use App\GambarProduk;
use App\Usaha;
use App\AlamatUser;
use Auth;
use DB;

class KeranjangController extends Controller
{
    public function index(){
        $usahanya = DB::table('keranjang_belanja')
                          ->join('produk', 'keranjang_belanja.id_produk', '=', 'produk.id')
                          ->join('usaha', 'produk.id_usaha', '=', 'usaha.id')
                          ->select('produk.id_usaha', 'usaha.nama_usaha')
                          ->distinct()
                          ->where('keranjang_belanja.id_user', Auth::user()->id)
                          ->get();

        $produknya = DB::table('keranjang_belanja')
                          ->join('produk', 'keranjang_belanja.id_produk', '=', 'produk.id')
                          ->join('usaha', 'produk.id_usaha', '=', 'usaha.id')
                          ->select('*')
                          ->where('keranjang_belanja.id_user', Auth::user()->id)
                          ->get();

        $gambarnya = GambarProduk::orderBy('id', 'DESC')->get();

        // return view('keranjang', compact('usahanya', 'produknya'));

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();

        $countkeranjang = count($keranjangku);
        return view('keranjang', compact('usahanya', 'produknya', 'gambarnya', 'punyausaha', 'countkeranjang'));
    }

    public function keranjangpost(Request $request){
        $keranjang = new Keranjang;
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->where('id_produk', $request['id_produk'])
                                ->first();
        if(empty($keranjangku)){
          $keranjang->id_user = Auth::user()->id;
          $keranjang->id_produk = $request['id_produk'];
          $keranjang->jumlah = $request['jumlah'];
          $keranjang->harga_jual = $request['harga'];
          $keranjang->save();
        }

        return redirect()->route('keranjang');
    }

    public function hapus(Request $request){
        Keranjang::where('id_user', Auth::user()->id)
                  ->where('id_produk', $request->id_produk)
                  ->delete();

        return redirect()->back()->with('hapus', 'Produk telah dihapus dari keranjang');
    }

    public function ubah(Request $request){
        Keranjang::where('id_user', Auth::user()->id)
                  ->where('id_produk', $request->id_produk)
                  ->update(['jumlah' => $request->jumlah]);

        return redirect()->back()->with('ubah', 'Keranjang telah diperbarui');
    }

    public function buatpesanan(Request $request){
        $usahanya = DB::table('keranjang_belanja')
                          ->join('produk', 'keranjang_belanja.id_produk', '=', 'produk.id')
                          ->join('usaha', 'produk.id_usaha', '=', 'usaha.id')
                          ->select('produk.id_usaha', 'usaha.nama_usaha', 'usaha.id_kota', 'usaha.id')
                          ->distinct()
                          ->where('keranjang_belanja.id_user', Auth::user()->id)
                          ->get();

        $produknya = DB::table('keranjang_belanja')
                          ->join('produk', 'keranjang_belanja.id_produk', '=', 'produk.id')
                          ->join('usaha', 'produk.id_usaha', '=', 'usaha.id')
                          ->select('*')
                          ->where('keranjang_belanja.id_user', Auth::user()->id)
                          ->get();

        $gambarnya = GambarProduk::orderBy('id', 'DESC')->get();

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();

        if($request->pilih){
          $alamatsaya = AlamatUser::where('id_user', Auth::user()->id)
                                  ->where('id', $request->id_almt)
                                  ->first();
        }else{
          $alamatsaya = AlamatUser::where('id_user', Auth::user()->id)
                                  ->first();
        }

        $semuaalamat = AlamatUser::where('id_user', Auth::user()->id)
                                ->get();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();

        $countkeranjang = count($keranjangku);
        if($countkeranjang === 0){
          return abort(404);
        }else{
          return view('pengiriman', compact('keranjangku', 'punyausaha', 'countkeranjang', 'alamatsaya', 'semuaalamat', 'usahanya', 'produknya', 'gambarnya'));
        }
    }

    public function cekongkir(Request $request){
      $asal = $request['asal'];
      $tujuan = $request['tujuan'];
      $kurir = $request['kurir'];

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=1700&courier=".$kurir."",
        CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key:2676bcf77d8b5739dd53e60afb2779bd"
        ),
      ));
      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $data = json_decode($response, true);
      }
      @$hasil = $data['rajaongkir']['results'][0]['costs'][1]['cost'][0]['value'];
      echo $hasil;
    }
}
