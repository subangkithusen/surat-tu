<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawaimodel extends Model
{
    protected $table = 'pegawai';

    function pegawaidivisi(){
    		return $this->hasOne('App\PegawaiDivisimodel','pegawai_id','id');
    }
}
