<?php

namespace App\Libs;
/**
 * Classe que fornece dados para uso nas views, tais como:
 * Nome da janela, rota e label do botão submit do formulário, etc...
 */

class DadosView
{
  protected $tituloPagina;
  protected $abaSelecionada;

  const ABA_BLOG = 'aba_blog';
  const ABA_FALE_CONOSCO = 'aba_fale_conosco';

  const ABA_GERENCIAR_POSTS = 'aba_gerenciar_posts';
  const ABA_GERENCIAR_CATEGORIAS = 'aba_gerenciar_categorias';
  const ABA_GERENCIAR_USUARIOS = 'aba_gerenciar_usuarios';

  function __construct($tituloPagina, $abaSelecionada)
  {
    $this->tituloPagina = $tituloPagina;
    $this->abaSelecionada = $abaSelecionada;
  }

  //Gets n Sets
  public function getTituloPagina(){
    return $this->tituloPagina;
  }

  public function setTituloPagina($titulo){
    $this->tituloPagina = $titulo;
  }

  public function getAbaSelecionada(){
    return $this->abaSelecionada;
  }

  public function setAbaSelecionada($aba){
    $this->abaSelecionada = $aba;
  }

  // Fim - Gets n Sets
}
