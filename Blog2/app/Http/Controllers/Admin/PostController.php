<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Categoria;
use App\Libs\Alert;
use App\Libs\DadosView;
use App\Libs\DadosViewForm;

class PostController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  //Exibe os posts cadastrados no blog
  public function index(){
    try{
      $posts = Post::orderBy('dataFantasia', 'desc')->get();

      $dados = new DadosView('Gerenciar posts', DadosView::ABA_GERENCIAR_POSTS);

      return view('admin.lista_posts', compact('posts', 'dados'));
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('admin.index');
    }
  }

  //View para cadastrar novo Post
  public function cadastrarPost(){
    try{
      $dados = new DadosViewForm('Cadastrar novo Post',
                  DadosViewForm::ABA_GERENCIAR_POSTS);
      $dados->setRotaSubmit(route('admin.salvar.post'));
      $dados->setLabelBotaoSubmit('Cadastrar');

      $categorias = Categoria::all();
      return view('admin.form_post', compact(['dados', 'categorias']));
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('admin.index');
    }
  }

  //View para editar um Post
  public function editarPost($id){
    try{
      $post = Post::findOrFail($id);

      $dados = new DadosViewForm('Alterar Post',
                  DadosViewForm::ABA_GERENCIAR_POSTS);
      $dados->setRotaSubmit(route('admin.atualizar.post', $id));
      $dados->setLabelBotaoSubmit('Atualizar');

      $categorias = Categoria::orderBy('titulo', 'asc')->get();
      return view('admin.form_post', compact(['dados', 'categorias', 'post']));
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('admin.index');
    }
  }

  //Salvar um post no banco de dados
  public function salvarPost(PostRequest $request){
    try{
      $data = \DateTime::createFromFormat("d/m/Y H:i", $request->input('dataFantasia'));

      //Cria o objeto Post
      $post = new Post;
      $post->titulo = $request->input('titulo');
      $post->texto = $request->input('texto');
      $post->dataFantasia = $data->format('Y-m-d H:i:s');
      $post->bloqueado = $request->input('bloqueado');
      $post->categoria_id = $request->input('categoria');
      $post->user_id = \Auth::user()->id;

      //Salvar no banco de dados
      $post->save();

      //Mensagem de sucesso
      Alert::success('Post cadastrado com sucesso!');
    } catch(\Exception $e){
      Alert::danger('Erro ao cadastrar o post');
    } finally {
      return redirect()->route('admin.cadastrar.post');
    }
  }

  //Atualizar o post no banco de dados
  public function atualizarPost(PostRequest $request, $id){
    try{
      //Cria um post a partir das requests
      $post = Post::findOrFail($id);
      $post-> dataFantasia = \DateTime::createFromFormat("d/m/Y H:i", $request->input('dataFantasia'));
      $post->titulo = $request->input('titulo');
      $post->texto = $request->input('texto');
      $post->bloqueado = $request->input('bloqueado');
      $post->categoria_id = $request->input('categoria');

      //Atualiza
      $post->save();

      //Mostra a mensagem de sucesso
      Alert::success('Post atualizado com sucesso!');
    } catch (\Exception $e){
      //Mostra a mensagem de erro
      Alert::danger('Falha ao atualizar o Post');
      return redirect()->route('admin.alterar.post', $id);
    }

    //Redireciona para o index do admin
    return redirect()->route('admin.index');
  }

  public function deletarPost($id){
    try{
      //Pega o post
      $post = Post::findOrFail($id);

      //Deleta todas as imagens referente ao Post
      $post->deletarImagens();

      //Deleta o post do banco de dados
      $post->delete();

      //Mostra a mensagem de sucesso
      Alert::success('Post deletado com sucesso');

    } catch (\Exception $e){
      Alert::danger('Falha ao deletar o post: '.$post->titulo.$e);
    }

    return redirect()->route('admin.index');
  }

  public function postImagens($id){
    try{
      $post = Post::findOrFail($id);

      return view('admin.lista_imagens', compact('post'));
    } catch(\Exception $e) {
      Alert::danger('Falha ao abrir as imagens do post');
    }

    return redirect()->route('admin.index');
  }
}
