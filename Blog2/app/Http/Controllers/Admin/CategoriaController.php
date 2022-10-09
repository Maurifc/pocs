<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Categoria;
use App\Libs\DadosView;
use App\Libs\DadosViewForm;
use App\Libs\Alert;

class CategoriaController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    //Exibe as categorias (View)
    public function listar(){
      try{
        $categorias = Categoria::orderBy('titulo', 'asc')->get();

        $dados = new DadosView('Gerenciar categorias', DadosView::ABA_GERENCIAR_CATEGORIAS);

        return view('admin.lista_categorias', compact('categorias', 'dados'))  ;
      } catch (\Exception $e){
        Alert::danger('Falha ao abrir a lista de categorias.');
        return redirect()->route('admin.index');
      }
    }

    //Exibe o form de edição de categorias
    public function alterarCategoria($idCategoria){
      try{
        $categoria = Categoria::findOrFail($idCategoria);

        $dados = new DadosViewForm('Editar categoria', DadosViewForm::ABA_GERENCIAR_CATEGORIAS);
        $dados->setRotaSubmit(route('admin.atualizar.categoria', $idCategoria));
        $dados->setLabelBotaoSubmit('Atualizar');

        return view('admin.form_categoria', compact('categoria', 'dados'));
      } catch (\Exception $e){
        Alert::danger('Falha ao abrir a categoria para edição');
        return redirect()->route('admin.listar.categorias');
      }
    }

    //Atualiza uma categoria no BD
    public function atualizarCategoria(CategoriaRequest $request, $idCategoria){
      try{
        Categoria::findOrFail($idCategoria)->update($request->all());

        Alert::success("Categoria atualizada com sucesso!");
        return redirect()->route('admin.listar.categorias');
      } catch (\Exception $e) {
        Alert::danger("Falha ao atualizar a categoria");
        return redirect()->route('admin.alterar.categoria', $idCategoria);
      }
    }

    //Exibe o form para a criação de um nova categoria
    public function cadastrar(){
      try{
        $dados = new DadosViewForm('Cadastrar categoria', DadosViewForm::ABA_GERENCIAR_CATEGORIAS);
        $dados->setRotaSubmit(route('admin.salvar.categoria'));
        $dados->setLabelBotaoSubmit('Cadastrar');

        return view('admin.form_categoria', compact('dados'));
      } catch (\Exception $e){
        Alert::danger('Falha abrir a página de cadastro de categorias');
        return redirect()->route('admin.listar.categorias');
      }
    }

    //Salva uma categoria no BD
    public function salvar(CategoriaRequest $request){
      try{
        Categoria::create($request->all());

        Alert::success("Categoria criada com sucesso!");
        return redirect()->route('admin.listar.categorias');
      } catch (\Exception $e) {
        Alert::danger("Falha ao criar a categoria");
        return redirect()->route('admin.cadastrar.categoria');
      }
    }

    //Apaga uma categoria do BD
    public function deletar($idCategoria){
      try{
        Categoria::findOrFail($idCategoria)->delete();

        Alert::success('Categoria deletada com sucesso!');
      } catch (\Exception $e){
        Alert::danger("Falha ao deletar a categoria");
      } finally {
        return redirect()->route('admin.listar.categorias');
      }
    }
}
