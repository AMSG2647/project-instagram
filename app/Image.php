<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images'; //Indicar el nombre de la table ne Base de datos

    //Relacionar tabla One To Many (1 a N) 

    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //Relacionar tabla One To Many (1 a N)

    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Relacion de muchos a 1 Many One

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
