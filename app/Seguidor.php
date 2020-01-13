<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguidor extends Model
{

    protected $table="seguidores";

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
