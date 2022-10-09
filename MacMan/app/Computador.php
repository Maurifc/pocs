<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computador extends Model
{
  protected $primaryKey = 'comp_id';
  protected $table = 'computadores';
  protected $fillable = [
    'cliente_id',
    'nome_estacao',
    'login',
    'grupo_trabalho',
    'dominio',
    'so_id',
    'so_arquitetura',
    'ip',
    'nome_usuario',
    'observacao',
  ];

  public function cliente(){
    return $this->belongsTo('App\Cliente', 'cliente_id');
  }

  public function licencas(){
    return $this->belongsToMany('App\Licenca', 'computador_licenca', 'comp_id', 'licenca_id');
  }

  public function so(){
    return $this->belongsTo('App\SistemaOperacional', 'so_id');
  }
}
