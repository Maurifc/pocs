<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\ImagemRequest;
use App\Imagem;
use App\Post;
use App\Libs\Alert;
use App\Libs\DadosView;
use App\Libs\DadosViewForm;
use App\Libs\ImagemUtil;

class ImagemController extends Controller
{
  const ABA = DadosView::ABA_GERENCIAR_POSTS;

  public function __construct(){
    $this->middleware('auth');
  }

  //View para alterar dados de uma determinada imagem
  public function alterarImagem($id){
    try{
      $imagem = Imagem::findOrFail($id);
      $post = $imagem->post;

      //Dados para o formulário
      $dados = new DadosViewForm('Alterar imagem', self::ABA);
      $dados->setRotaSubmit(route('admin.atualizar.imagem', $imagem->id));
      $dados->setLabelBotaoSubmit('Atualizar');

      return view('admin.form_img', compact('imagem', 'dados', 'post'));
    } catch (\Exception $e) {
      Alert::danger('Falha ao abrir a imagem para alterações');
    }

    return redirect()->route('admin.post.imagens');
  }

  //Exibe a view para upload de imagem
  public function uploadImagem($id){
    try{
      $post = Post::findOrFail($id);

      $dados = new DadosViewForm('Upload de imagem', self::ABA);
      $dados->setRotaSubmit(route('admin.salvar.imagem', $id));
      $dados->setLabelBotaoSubmit('Enviar');

      return view('admin.form_img', compact('dados', 'post'));
    } catch(\Exception $e){
      Alert::danger('Falha ao abrir sua solicitação');
    }

    return redirect()->route('admin.post.imagens', $id);
  }

  //Salva uma imagem no disco e no bd
  public function salvarImagem(ImagemRequest $request, $postId){
    try{
      //Pega o post que a imagem pertence
      $post = Post::findOrFail($postId);

      //Salva a imagem no disco (já criando as miniaturas)
      $nomeImagem = ImagemUtil::salvar($request->file('imagem')); ;

      //Monta o model para inserção no banco de dados
      $imagemModel = new Imagem();
      $imagemModel->legenda = $request->input('legenda');
      $imagemModel->nomeArquivo = $nomeImagem;

      //Verifica se já existe uma imagem em destaque no Post
      if($post->imagemDestaque()){
        $imagemModel->imagemDestaque = 0; //Caso exista, ela é inserida como imagem comum
      } else {
        $imagemModel->imagemDestaque = $request->input('imagemDestaque');
      }

      //insere no banco de dados
      $post->imagens()->save($imagemModel);

      //mensagem de sucesso
      Alert::success('Imagem '.$imagemModel->legeda.' inserida com sucesso!');

    } catch (\Exception $e){
      Alert::danger("Falha ao inserir a imagem".$e);
    }

    //Retorna para a página de upload de imagens
    return redirect()->route('admin.upload.imagem', $post->id);
  }

  //Atualiza uma imagem no banco de dados
  public function atualizarImagem(ImagemRequest $request, $imagemId){
    try{
      $imagem = Imagem::findOrFail($imagemId);
      $imagem->update($request->all());

      Alert::success('Imagem atualizada com sucesso!');
    } catch (\Exception $e) {
      Alert::danger('Falha ao atualizar a imagem no banco de dados');
    }

    return redirect()->route('admin.post.imagens', $imagem->post->id);
  }

  //Remove uma imagem
  public function removerImagem($id){
    try{
      $imagem = Imagem::findOrFail($id);

      //Remove a imagem do disco
      ImagemUtil::deletar($imagem);

      //Remove do bd
      $imagem->delete();

      //mensagem de sucesso
      Alert::success("Imagem ".$imagem->legenda." removida com sucesso");

    } catch (\Exception $e){
      //mensagem de erro
      Alert::danger('Erro ao tentar remover a imagem '.$imagem->legenda.$e);
    }

    //Exibe a lista de imagens do post novamente
    return redirect()->route('admin.post.imagens', $imagem->post->id);
  }

}
