<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suratmasukmodel extends Model
{
    //
    public $timestamps  = false;
    protected $table = 'suratmasuks';
    protected $fillable = ['dari','no_agenda','tanggal_surat','tanggal_diterima','jenis_surat','nomer_surat','perihal'];
   

    public function jenissurat(){
    	return $this->belongsTo('App\Jenissuratmodel','id','jenis_surat');
    }

    public function files(){
    	return $this->hasMany('App\Filesmodel','surat_id','id');
    }

    public function js(){
        return $this->belongsTo('App\Jenissuratmodel','jenis_surat','id');
    }
}
