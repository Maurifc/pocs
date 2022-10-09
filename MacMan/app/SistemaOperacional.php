<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SistemaOperacional extends Model
{
    protected $table = 'sistemas_operacionais';
    protected $primaryKey = 'so_id';

    public function computadores(){
      return $this->hasMany('App\Computador', 'so_id');
    }
}
