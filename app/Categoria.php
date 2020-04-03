<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categories';
    public $timestamps = false;
    
    public function movie()
    {
        return $this->hasMany('App\Movie');
    }

}
