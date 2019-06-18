<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usaha extends Model
{
    public function user(){
        return $this->belongsTo('App\User', 'id_user');
    }

    public function provinsi(){
        return $this->belongsTo('App\Provinsi', 'id_provinsi', 'province_id');
    }

    public function kabupaten(){
        return $this->belongsTo('App\Kabupaten', 'id_kota', 'city_id');
    }

    public function produk(){
        return $this->hasMany('App\Produk');
    }

    protected $table ="usaha";
    protected $fillable = [
      'id_user',
      'nama_usaha',
      'logo_usaha',
      'deskripsi_usaha',
      'foto_ktp',
      'foto_dengan_ktp',
      'siup',
      'id_provinsi',
      'id_kota',
      'kode_pos',
      'alamat_usaha',
      'status_usaha',
    ];
}
