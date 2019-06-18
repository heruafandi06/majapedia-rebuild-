<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    public function provinsi(){
        return $this->belongsTo('App\Provinsi', 'id_provinsi', 'province_id');
    }

    public function kabupaten(){
        return $this->belongsTo('App\Kabupaten', 'id_kota', 'city_id');
    }

    protected $table = "alamat_user";

    protected $fillable = ['id_user', 'jenis_alamat', 'id_provinsi', 'id_kota', 'kode_pos', 'alamat'];
}
