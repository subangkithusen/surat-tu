<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disposisimohonmomdel extends Model
{
    protected $table = 'disposisi_mohon';
    protected $fillable = ['disposisis_id','mohon_id',];
    public $timestamps = true;
}
