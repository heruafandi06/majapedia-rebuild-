<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
	public function pemesanan(){
        return $this->belongsTo('App\Pemesanan');
    }
	
    protected $table = "ongkir";
    protected $fillable = ['id_pemesanan', 'id_usaha', 'ongkir'];
}
