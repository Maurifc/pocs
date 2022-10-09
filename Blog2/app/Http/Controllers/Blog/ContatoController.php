<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContatoRequest;
use App\Libs\Alert;
use App\Libs\DadosView;

class ContatoController extends Controller
{
  const ABA = DadosView::ABA_FALE_CONOSCO;
  //Mostra o form para envio de emails para contato
  public function mostrarForm(){
    try{
      $dados = new DadosView('Fale conosco', self::ABA);

      return view('blog.contato', compact('dados'));
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('post.index');
    }
  }

  //Envia o email para contato
  public function enviarEmail(ContatoRequest $request){
    //Envio de email não implementado

    try{
      Alert::success("Mensagem enviada com sucesso, aguarde nosso contato.");
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
    }

    return redirect()->route('post.index');
  }
}
