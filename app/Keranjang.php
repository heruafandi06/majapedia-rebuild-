<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function produk(){
        return $this->belongsTo('App\Produk', 'id_produk');
    }

    protected $table = 'keranjang_belanja';
    protected $fillable = ['id_user', 'id_produk', 'jumlah', 'harga_jual'];
}
