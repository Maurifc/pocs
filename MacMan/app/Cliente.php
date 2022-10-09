<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $fillable = ['nome', 'email', 'observacao'];
  protected $primaryKey = 'cliente_id';

  public function computadores(){
    return $this->hasMany('App\Computador', 'cliente_id');
  }

  public function telefones(){
    return $this->hasMany('App\Telefone', 'cliente_id');
  }

  public function endereco(){
    return $this->hasOne('App\Endereco', 'cliente_id');
  }

  public function licencas(){
    return $this->hasMany('App\Licenca', 'cliente_id');
  }

}
