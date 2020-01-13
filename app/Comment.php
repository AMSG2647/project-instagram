<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // Relacion de muchos a 1 Many One
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    // Relacion de muchos a 1 Many One
    public function image(){
        return $this->belongsTo('App\Image','image_id');
    }

}
