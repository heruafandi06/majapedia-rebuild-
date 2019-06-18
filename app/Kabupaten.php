<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public function alamatuser(){
        return $this->hasMany('App\AlamatUser');
    }

    public function alamatusaha(){
        return $this->hasMany('App\Usaha');
    }

    protected $table = "kabupaten";

    protected $fillable = ['province_id', 'province', 'city_name'];
}
