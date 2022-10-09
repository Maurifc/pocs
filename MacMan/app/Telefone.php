<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $primaryKey = 'telefone_id';

    public function cliente(){
      return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}
