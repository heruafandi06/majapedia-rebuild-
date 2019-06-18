<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    public function produk(){
        return $this->belongsTo('App\Produk', 'id_produk', 'id');
    }

    protected $table = "gambar_produk";
    protected $fillable = ['id_produk', 'url'];
}
