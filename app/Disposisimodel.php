<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisimodel extends Model
{
    protected $table = 'disposisi';
    protected $fillable = ['suratmasuk_id','user_id','to_user','divisi_id','isidisposisi','tanggapan','tanggal_disposisi'];
    public $timestamps = false;


    //hasMany

    public function pegawai(){
    	return $this->belongsTo('App\Pegawaimodel','to_user','id');
    }

    public function divisi(){
    	return $this->belongsTo('App\Divisimodel','divisi_id','id');	
    }

    public function suratmasuk(){
    	return $this->belongsTo('App\Suratmasukmodel','suratmasuk_id','id');	

    }


    //belongsTo
    


}
