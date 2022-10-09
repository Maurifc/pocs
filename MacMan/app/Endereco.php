<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $primaryKey = 'endereco_id';

    public function cliente(){
      return $this->belongsTo('App\Cliente', 'cliente_id');
    }
}
