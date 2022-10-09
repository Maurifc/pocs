<?php

namespace App\Libs;
/**
 * Classe que fornece dados para uso nas views, tais como:
 * Nome da janela, rota e label do botão submit do formulário, etc...
 */

class DadosViewForm extends DadosView
{
  private $rotaSubmit;
  private $labelBotaoSubmit;
  private $tituloForm;
  private $modo;

  //Constantes
  const MODO_CADASTRO = 'modo_cadastro';
  const MODO_EDICAO = 'modo_edicao';

  //Construtor herdado

  //Gets n Sets
  public function getRotaSubmit(){
    return $this->rota;
  }

  public function setRotaSubmit($rota){
    $this->rota = $rota;
  }

  public function getLabelBotaoSubmit(){
    return $this->labelBotaoSubmit;
  }

  public function setLabelBotaoSubmit($labelBotaoSubmit){
    $this->labelBotaoSubmit = $labelBotaoSubmit;
  }

  public function getTituloForm(){
    return $this->tituloForm;
  }

  public function setTituloForm($tituloForm){
    $this->tituloForm = $tituloForm;
  }

  public function getModo(){
    return $this->modo;
  }

  public function setModo($modo){
    $this->modo = $modo;
  }

  // Fim - Gets n Sets
}
