<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
| Blog
*/
//Página inicial
Route::get('/', 'Blog\PostController@index')->name('post.index');

//Exibir um post (view)
Route::get('/post/{id}', 'Blog\PostController@mostrarPost')->name('post.mostrar');

//Exibe posts somente de uma determinada categoria
Route::get('/posts/categoria/{id}', 'Blog\PostController@mostraPorCategoria')->name('post.categoria');

//Exibe a página de contato
Route::get('/contato', 'Blog\ContatoController@mostrarForm')->name('contato.form');

//Envia o email de contato
Route::post('/contato/enviaremail', 'Blog\ContatoController@enviarEmail')->name('contato.enviaremail');

/*
| Painel do Administrador
*/
//Rotas de login
Auth::routes();

//Logout
Route::get('/admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

//Index do Admin
Route::get('/admin', 'Admin\PostController@index')->name('admin.index');

/*
| Posts
*/
//View de cadastro de posts
Route::get('admin/post/cadastrar', 'Admin\PostController@cadastrarPost')->name('admin.cadastrar.post');

//View para edição de post
Route::get('admin/post/alterar/{id}', 'Admin\PostController@editarPost')->name('admin.alterar.post');

//Salvar o post no banco de dados
Route::post('admin/post/salvar', 'Admin\PostController@salvarPost')->name('admin.salvar.post');

//Atualizar um post no banco de dados
Route::post('admin/post/atualizar/{id}', 'Admin\PostController@atualizarPost')->name('admin.atualizar.post');

//Remover um post do banco de dados
Route::get('admin/post/deletar/{id}', 'Admin\PostController@deletarPost')->name('admin.deletar.post');

//View para gerenciar imagens de um Post
Route::get('admin/post/imagens/{id}', 'Admin\PostController@postImagens')->name('admin.post.imagens');

/*
| Imagens
*/
//View para editar imagem de um Post
Route::get('admin/imagem/alterar/{id}', 'Admin\ImagemController@alterarImagem')->name('admin.alterar.imagem');

//View para cadastrar imagem para um Post
Route::get('admin/imagem/upload/{id}', 'Admin\ImagemController@uploadImagem')->name('admin.upload.imagem');

//Atualiza as informações de uma imagem no bd
Route::post('admin/imagem/salvar/{id}', 'Admin\ImagemController@salvarImagem')->name('admin.salvar.imagem');

//Atualiza as informações de uma imagem no bd
Route::post('admin/imagem/atualizar/{id}', 'Admin\ImagemController@atualizarImagem')->name('admin.atualizar.imagem');

//Remove uma imagem do bd
Route::get('admin/imagem/remover/{id}', 'Admin\ImagemController@removerImagem')->name('admin.remover.imagem');

/*
| Categorias
*/
//Exibe uma lista de categorias
Route::get('admin/categoria/listar', 'Admin\CategoriaController@listar')->name('admin.listar.categorias');

//Exibe o form para edição da categoria
Route::get('admin/categoria/alterar/{id}', 'Admin\CategoriaController@alterarCategoria')->name('admin.alterar.categoria');

//Atualiza as informações de uma categoria no bd
Route::post('admin/categoria/atualizar/{id}', 'Admin\CategoriaController@atualizarCategoria')->name('admin.atualizar.categoria');

//Exibe o form para cadastro de categoria
Route::get('admin/categoria/cadastrar', 'Admin\CategoriaController@cadastrar')->name('admin.cadastrar.categoria');

//Salva a categoria no bd
Route::post('admin/categoria/salvar/', 'Admin\CategoriaController@salvar')->name('admin.salvar.categoria');

//Apaga uma categoria
Route::get('admin/categoria/deletar/{id}', 'Admin\CategoriaController@deletar')->name('admin.deletar.categoria');

/*
| Usuários
*/
//Exibe uma lista de usuários
Route::get('admin/usuario/listar', 'Admin\UsuarioController@listar')->name('admin.listar.usuarios');

//Exibe o form para cadastro de usuários
Route::get('admin/usuario/cadastrar', 'Admin\UsuarioController@cadastrar')->name('admin.cadastrar.usuario');

//Exibe o form para edição do usuário
Route::get('admin/usuario/alterar/{id}', 'Admin\UsuarioController@alterar')->name('admin.alterar.usuario');

//Exibe o form alterar a senha
Route::get('admin/usuario/alterar/senha/{id}', 'Admin\UsuarioController@alterarSenha')->name('admin.alterar.senha.usuario');

//Atualiza o usuário no bd
Route::post('admin/usuario/atualizar/{id}', 'Admin\UsuarioController@atualizar')->name('admin.atualizar.usuario');

//Atualiza a senha do usuário no bd
Route::post('admin/usuario/atualizar/senha/{id}', 'Admin\UsuarioController@atualizarSenha')->name('admin.atualizar.senha.usuario');

//Bloqueia um usuário
Route::get('admin/usuario/bloquear/{id}', 'Admin\UsuarioController@desativar')->name('admin.desativar.usuario');

//Desbloqueia um usuário
Route::get('admin/usuario/desbloquear/{id}', 'Admin\UsuarioController@reativar')->name('admin.reativar.usuario');

//Exclui um usuário
Route::get('admin/usuario/excluir/{id}', 'Admin\UsuarioController@excluir')->name('admin.excluir.usuario');
