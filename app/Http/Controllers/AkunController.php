<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AlamatUser;
use App\Provinsi;
use App\Usaha;
use App\Keranjang;
use Auth;

class AkunController extends Controller
{
    public function profil()
    {
        $user = User::where('id', Auth::user()->id)
                ->firstOrFail();
        ;

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('akun.profil', compact('user', 'punyausaha', 'countkeranjang'));
    }

    public function updateprofil(Request $request)
    {
        $this->validate($request, [
          'username' => ['required', 'string', 'max:255'],
          'nama_user' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255'],
          'telp' => ['required', 'numeric'],
        ]);

        if($request->username !== Auth::user()->username){
            $this->validate($request, [
              'username' => ['required', 'string', 'max:255', 'unique:users'],
            ]);

            if($request->email !== Auth::user()->email){
                $this->validate($request, [
                  'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }

            User::where('id', Auth::user()->id)
                  ->update(['username' => $request->username, 'nama_user' => $request->nama_user, 'email' => $request->email, 'telp' => $request->telp]);

            return redirect()->route('profil')->with('message', 'Perubahan profil Anda disimpan.');
        }else if($request->email !== Auth::user()->email){
            $this->validate($request, [
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            User::where('id', Auth::user()->id)
                  ->update(['username' => $request->username, 'nama_user' => $request->nama_user, 'email' => $request->email, 'telp' => $request->telp, 'email_verified_at' => null]);

            return redirect()->route('verification.notice');
        }else{
            User::where('id', Auth::user()->id)
                  ->update(['username' => $request->username, 'nama_user' => $request->nama_user, 'email' => $request->email, 'telp' => $request->telp]);

            return redirect()->route('profil')->with('message', 'Perubahan profil Anda disimpan.');
        }
    }

    public function daftaralamat()
    {
        $alamat = AlamatUser::where('id_user', Auth::user()->id)
                    ->get();
        ;

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('akun.daftar-alamat', compact('alamat', 'punyausaha', 'countkeranjang'));
    }

    public function alamat()
    {
        $provinsi = Provinsi::All();

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();
        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('akun.tambah-alamat', compact('provinsi', 'punyausaha', 'countkeranjang'));
    }

    public function tambahalamat(Request $request)
    {
        $this->validate($request, [
          'jenis_alamat' => ['required', 'string', 'max:255'],
          'kode_pos' => ['required', 'numeric'],
          'alamat_lengkap' => ['required', 'string', 'max:255'],
        ]);

        $alamat = new AlamatUser();
        $alamat->id_user = Auth::user()->id;
        $alamat->jenis_alamat = $request['jenis_alamat'];
        $alamat->id_provinsi = $request['provinsi'];
        $alamat->id_kota = $request['kota'];
        $alamat->kode_pos = $request['kode_pos'];
        $alamat->alamat = $request['alamat_lengkap'];
        $alamat->save();

        return redirect()->route('daftar-alamat')->with('message', 'Alamat telah ditambahkan.');
    }

    public function ubahalamat($id)
    {
        $alamat = AlamatUser::where('id_user', Auth::user()->id)
                    ->where('id', $id)
                    ->firstOrFail();
        ;

        $provinsi = Provinsi::All();

        $punyausaha = Usaha::where('id_user', Auth::user()->id)->first();

        $keranjangku = Keranjang::where('id_user', Auth::user()->id)
                                ->get();
        $countkeranjang = count($keranjangku);

        return view('akun.ubah-alamat', compact('alamat', 'provinsi', 'punyausaha', 'countkeranjang'));
    }

    public function postubahalamat(Request $request, $id)
    {
        $this->validate($request, [
          'jenis_alamat' => ['required', 'string', 'max:255'],
          'kode_pos' => ['required', 'numeric'],
          'alamat_lengkap' => ['required', 'string', 'max:255'],
        ]);

        $alamat = AlamatUser::where('id_user', Auth::user()->id)
                  ->where('id', $id)
                  ->update(['jenis_alamat' => $request->jenis_alamat, 'id_provinsi' => $request->provinsi, 'id_kota' => $request->kota, 'kode_pos' => $request->kode_pos, 'alamat' => $request->alamat_lengkap]);

        return redirect()->route('daftar-alamat')->with('message', 'Alamat telah diperbarui.');
    }

    public function hapusalamat(Request $request, $id)
    {
        $alamat = AlamatUser::where('id_user', Auth::user()->id)
                  ->where('id', $id)
                  ->firstOrFail();
        ;

        $alamat->delete();

        return redirect()->route('daftar-alamat')->with('message', 'Alamat telah dihapus.');
    }
}
