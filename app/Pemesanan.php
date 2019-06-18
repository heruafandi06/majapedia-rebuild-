<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
	public function pemesanandetil(){
        return $this->hasMany('App\PemesananDetil');
    }

    public function ongkir(){
        return $this->hasMany('App\Ongkir');
    }

    protected $table = "pemesanan";
    protected $fillable = ['id_user', 'id_alamat', 'tgl_pemesanan', 'total'];
}
