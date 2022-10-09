<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licenca extends Model
{
    protected $primaryKey = 'licenca_id';
    protected $fillable = [
      'cliente_id',
      'nome_software',
      'chave',
      'login',
      'senha',
      'data_expiracao',
      'observacao',
    ];
    
    public function cliente(){
      return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function computadores(){
      return $this->belongsToMany('App\Computador', 'computador_licenca', 'licenca_id', 'comp_id');
    }
}
