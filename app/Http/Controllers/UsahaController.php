<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Usaha;
Use App\Provinsi;
use App\GambarProduk;
use App\KategoriProduk;
use App\Produk;
use App\Keranjang;
use Auth;
use Illuminate\Support\Str;

class UsahaController extends Controller
{
    public function index()
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        if(empty($punyausaha)){
            $provinsi = Provinsi::all();
            return view('usaha.mulai', ['provinsi' => $provinsi]);
        }else{
            return redirect()->route('profil-usaha');
        }
    }

    public function bukausaha(Request $request)
    {
        $this->validate($request, [
          'nama_usaha' => ['required', 'string', 'max:255', 'unique:usaha'],
        ]);

        $usaha = new Usaha();
        $iduser = Auth::user()->id;
        $nama = $request['nama_usaha'];
        $destinationPath = 'file/';

        $logo = $request->file('logo_usaha')->getClientOriginalName();
        $request->file('logo_usaha')->move($destinationPath, $logo);

        $deskripsi = $request['deskripsi_usaha'];

        $fotoktp = $request->file('foto_ktp')->getClientOriginalName();
        $request->file('foto_ktp')->move($destinationPath, $fotoktp);

        $fotodgnktp = $request->file('foto_dengan_ktp')->getClientOriginalName();
        $request->file('foto_dengan_ktp')->move($destinationPath, $fotodgnktp);

        $siup = $request->file('siup')->getClientOriginalName();
        $request->file('siup')->move($destinationPath, $siup);

        $idprovinsi = $request['provinsi'];
        $idkota = $request['kota'];
        $kodepos = $request['kode_pos'];
        $alamat = $request['alamat_usaha'];
        Usaha::create([
                "id_user"    => Auth::user()->id,
                "nama_usaha" => $nama,
                "logo_usaha" => $logo,
                "deskripsi_usaha" => $deskripsi,
                "foto_ktp" => $fotoktp,
                "foto_dengan_ktp" => $fotodgnktp,
                "siup" => $siup,
                "id_provinsi" => $idprovinsi,
                "id_kota" => $idkota,
                "kode_pos" => $kodepos,
                "alamat_usaha" => $alamat,
            ]);

        return redirect()->route('home');
    }

    public function profilusaha()
    {
        $provinsi = Provinsi::All();

        $usahasaya = Usaha::where('id_user', Auth::user()->id)
                ->firstOrFail();
        ;

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('usaha.profil-usaha', compact('provinsi', 'usahasaya', 'punyausaha', 'countkeranjang'));
    }

    public function updateprofil(Request $request)
    {
        $this->validate($request, [
          'deskripsi_usaha' => ['required', 'string', 'max:255'],
          'kode_pos' => ['required', 'numeric'],
          'alamat_usaha' => ['required', 'string', 'max:255'],
        ]);

        $usahasaya = Usaha::where('id_user', Auth::user()->id)
                ->firstOrFail();
        ;

        if($request->nama_usaha !== $usahasaya->nama_usaha){
            $this->validate($request, [
              'nama_usaha' => ['required', 'string', 'max:255', 'unique:usaha'],
            ]);
        }

        Usaha::where('id', $usahasaya->id)
              ->where('id_user', Auth::user()->id)
              ->update(['nama_usaha' => $request->nama_usaha, 'deskripsi_usaha' => $request->deskripsi_usaha, 'id_provinsi' => $request->provinsi, 'id_kota' => $request->kota, 'kode_pos' => $request->kode_pos, 'alamat_usaha' => $request->alamat_usaha]);

        return redirect()->route('profil-usaha')->with('message', 'Perubahan profil usaha Anda disimpan.');
    }

    public function tambahproduk()
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);
        if(empty($punyausaha)){
            return abort(404);
        }else{
            if($punyausaha->status_usaha == 1){
              $kategori = KategoriProduk::all();
              return view('usaha.tambah-produk', compact('punyausaha', 'kategori', 'countkeranjang'));
            }else{
              return redirect()->route('profil-usaha')->with('gagal', 'Usaha Anda belum disetujui oleh Admin');;
            }
        }
    }

    public function tambahprodukpost(Request $request)
    {
        $this->validate($request, [
              'file.*' => 'mimes:jpg,jpeg,png',
              'nama_produk' => ['required', 'string', 'max:255'],
              'kategori' => ['required'],
              'harga' => ['required', 'numeric'],
              'berat' => ['required', 'numeric'],
              'stok' => ['required', 'numeric'],
              'deskripsi' => ['required', 'string', 'max:255'],
        ]);

        $idproduk = Produk::max('id');
        $idproduk++;

        if($request->hasfile('file'))
        {
            foreach($request->file('file') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/file/', $name);
                // $data[] = $name;
                $file= new GambarProduk();
                $file->id_produk=$idproduk;
                $file->url=$name;
                $file->save();
            }
        }

        $produk = new Produk();
        $produk->id = $idproduk;
        $produk->id_kategori = $request['kategori'];
        $produk->id_usaha = $request['id_usaha'];
        $produk->nama_produk = $request['nama_produk'];
        $produk->slug_produk = Str::slug($request['nama_produk']);
        $produk->harga = $request['harga'];
        $produk->stok = $request['stok'];
        $produk->berat = $request['berat'];
        $produk->deskripsi_produk = $request['deskripsi'];
        $produk->save();

        return redirect()->route('daftar-produk')->with('message', 'Produk berhasil ditambahkan');
    }

    public function daftarproduk()
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);
        if(empty($punyausaha)){
            return abort(404);
        }else{
            if($punyausaha->status_usaha == 1){
              $idusaha = $punyausaha->id;
              $produksaya = Produk::where('id_usaha', $idusaha)
                                  ->orderBy('id', 'DESC')
                                  ->get();
              return view('usaha.daftar-produk', compact('punyausaha', 'produksaya', 'countkeranjang'));
            }
            return redirect()->route('profil-usaha')->with('gagal', 'Usaha Anda belum disetujui oleh Admin');
        }
    }

    public function ubahproduk($id)
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->firstOrFail();
        $produk = Produk::where('id', $id)
                        ->where('id_usaha', $punyausaha->id)
                        ->firstOrFail();
        $kategori = KategoriProduk::all();
        $gambarproduk = GambarProduk::where('id_produk', $id)
                                    ->get();
        $gambarproduk2 = GambarProduk::where('id_produk', $id)
                                    ->get();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('usaha.ubah-produk', compact('punyausaha', 'produk', 'kategori', 'gambarproduk', 'gambarproduk2', 'countkeranjang'));
    }

    public function ubahprodukpost(Request $request, $id)
    {
        if($request->hasfile('file'))
        {
          foreach($request->file('file') as $file)
          {
            $name=$file->getClientOriginalName();
            $file->move(public_path().'/file/', $name);
            // $data[] = $name;
            $file= new GambarProduk();
            $file->id_produk=$id;
            $file->url=$name;
            $file->save();
          }
        }

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $produk = Produk::where('id', $id)
                        ->where('id_usaha', $punyausaha->id)
                        ->update(['id_kategori' => $request->kategori, 'id_usaha' => $request->id_usaha, 'nama_produk' => $request->nama_produk, 'harga' => $request->harga, 'stok' => $request->stok, 'berat' => $request->berat, 'deskripsi_produk' => $request->deskripsi]);

        return redirect()->route('daftar-produk')->with('message', 'Produk berhasil diperbarui');
    }

    public function hapusgambar(Request $request, $id)
    {
        $gambarproduk = GambarProduk::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function hapusproduk($id)
    {
        $punyausaha = Usaha::where('id_user', Auth::user()->id)->firstOrFail();
        Produk::where('id_usaha', $punyausaha->id)
              ->findOrFail($id)
              ->delete();
        GambarProduk::findOrFail($id)
              ->delete();

        return redirect()->route('daftar-produk')->with('message', 'Produk berhasil dihapus');
    }
}
