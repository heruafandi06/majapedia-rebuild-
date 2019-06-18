<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananDetil extends Model
{
	public function pemesanan(){
        return $this->belongsTo('App\Pemesanan');
    }

    protected $table = "pemesanan_detil";
    protected $fillable = ['id_pemesanan', 'id_produk', 'jumlah', 'harga_jual', 'status_pemesanan'];
}
