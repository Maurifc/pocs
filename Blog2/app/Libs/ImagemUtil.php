<?php

namespace App\Libs;
use App\Imagem;
use Intervention\Image\ImageManagerStatic as Image;

class ImagemUtil{

  /*
  |Salva uma imagem no disco (normal, pequena e média)
  | Retorna o nome gerado na função (randomico)
  */
  public static function salvar($arqImagem){

    //Pega a imagem (como objeto do Intervention Image)
    $imagem = Image::make($arqImagem); ;

    //Gera um nome randomico para a imagem e a extensão png
    do{
      $numeroRandomico = rand( 100000, 999999999);
    }while(Imagem::where(Imagem::COLUNA_NOME, $numeroRandomico)->get() === true);
    $nomeImagem = $numeroRandomico.'.png';

    //Salva na pasta Upload/imgs com a extegonsão definida acima
    $imagem->save('uploads/imgs/'.$nomeImagem, 80);

    //Salva a imagem (de tamanho médio) na pasta Upload/imgs/md
    $imagem->resize(420, 270)->save('uploads/imgs/md/'.$nomeImagem);

    //Salva a imagem (de tamanho pequeno) na pasta Upload/imgs/sm
    $imagem->crop(66, 66)->save('uploads/imgs/sm/'.$nomeImagem);

    return $nomeImagem;
  }

  /*
  | Apaga uma imagem dos diretórios no disco
  */
  public static function deletar(Imagem $imagem){
    \File::delete($imagem->caminho());
    \File::delete($imagem->caminhoSm());
    \File::delete($imagem->caminhoMd());
  }
}
