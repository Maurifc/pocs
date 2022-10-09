<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
  protected $fillable = ['post_id', 'legenda', 'nomeArquivo', 'imagemDestaque'];
  const CAMINHO_PASTA_IMAGENS ='/uploads/imgs/';
  const COLUNA_NOME = 'nomeArquivo';
  const PASTA_SM = 'sm';
  const PASTA_MD = 'md';

  public function post(){
    return $this->belongsTo(Post::class);
  }

  public function urlSm(){
    return url($this->url(self::PASTA_SM));
  }

  public function urlMd(){
    return url($this->url(self::PASTA_MD));
  }

  /*
  |Retona a url da imagem
  |Retorna a url da imagem em uma subpasta, caso a subpasta seja informada no
  |                                                             parâmetro
  */
  public function url($subpasta=null){
    $path = self::CAMINHO_PASTA_IMAGENS;

    //Se recebeu uma subspasta (por parâmetro), então concatena no final do caminho
    if(isset($subpasta)){
      $path = $path.$subpasta.'/';
    }

    return url($path.$this->nomeArquivo);
  }

  public function caminhoSm(){
    return $this->caminho(self::PASTA_SM);
  }

  public function caminhoMd(){
    return $this->caminho(self::PASTA_MD);
  }

  /*
  |Retona o caminho da imagem
  |Retorna o caminho da imagem em uma subpasta, caso a subpasta seja informada no
  |                                                             parâmetro
  */
  public function caminho($subpasta=null){
    $path = public_path().self::CAMINHO_PASTA_IMAGENS;

    //Trata o parâmetro (adiciona uma '/' ao final do caminho)
    if(isset($subpasta)){
      $path = $path.$subpasta.'/';
    }

    return $path.$this->nomeArquivo;
  }

}
