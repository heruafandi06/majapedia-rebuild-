<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    public function alamatuser(){
        return $this->hasMany('App\AlamatUser');
    }

    public function alamatusaha(){
        return $this->hasMany('App\Usaha');
    }

    protected $table = "province";

    protected $fillable = ['province'];
}
