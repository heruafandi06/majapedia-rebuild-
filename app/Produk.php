<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function gambar(){
        return $this->hasOne('App\GambarProduk', 'id_produk', 'id');
    }

    public function usaha(){
        return $this->belongsTo('App\Usaha', 'id_usaha');
    }

    public function kategori(){
        return $this->belongsTo('App\KategoriProduk', 'id_kategori');
    }

    public function keranjang(){
        return $this->hasMany('App\Keranjang', 'id_produk');
    }

    protected $table = "produk";
    protected $fillable = ['id_kategori', 'id_usaha', 'nama_produk', 'slug_produk', 'harga', 'stok', 'berat', 'deskripsi_produk'];
}
