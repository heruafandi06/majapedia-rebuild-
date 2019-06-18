<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;

class ProvinsiController extends Controller
{
    public function pilihkota(Request $request)
    {
        $kabupaten = Kabupaten::where('province_id', $request->provinsi)
                  ->get();
        ;

        return view('akun.pilih-kota', ['kabupaten' => $kabupaten]);
    }
}
