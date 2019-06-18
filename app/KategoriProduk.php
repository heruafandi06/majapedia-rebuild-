<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    public function produk(){
        return $this->hasMany('App\Produk');
    }

    protected $table = "kategori_produk";
    protected $fillable = ['nama_kategori'];
}
