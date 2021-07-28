<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filesmodel extends Model
{
	public $timestamps = false;
    protected $table = 'files';
    protected $fillable = ['surat_type','surat_id','file_path','file_original','mime','keterangan'];
}
