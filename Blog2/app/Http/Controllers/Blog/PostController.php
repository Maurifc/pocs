<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Post;
use App\Categoria;
use App\Libs\Alert;
use App\Libs\DadosView;
use DB;
use Illuminate\Http\Request;


class PostController extends Controller
{
  const ABA = DadosView::ABA_BLOG;

  //Exibe todos os posts
  public function index(){
    try{
      $posts = Post::orderBy('dataFantasia', 'desc')->paginate(6);

      return $this->mostrar($posts);
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('post.index');
    }
  }

  //Exibe posts por categoria
  public function mostraPorCategoria($id){
    try{
      $posts = Post::where('categoria_id', $id)->
      orderBy('dataFantasia', 'desc')->paginate(6);


      return $this->mostrar($posts);
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('post.index');
    }
  }

  //Exibe os posts informados no parametro
  public function mostrar($posts){
    $dados = new DadosView(config('app.name'), self::ABA);

    $categorias = Categoria::all();
    return view('blog.inicio', compact(['posts', 'categorias', 'dados']));
  }

  //Carrega a view de exibição de post
  public function mostrarPost($id){
    try{
      $post = Post::findOrFail($id);
      $categorias = Categoria::all();
      $dados = new DadosView($post->titulo, self::ABA);

      return view('blog.post', compact(['post', 'categorias', 'dados']));
    } catch (\Exception $e){
      Alert::danger('Falha ao processar a requisição');
      return redirect()->route('post.index');
    }
  }



}
