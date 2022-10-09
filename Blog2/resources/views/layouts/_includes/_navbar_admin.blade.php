@php
  $aba = (isset($dados) && $dados->getAbaSelecionada() !== null) ?
                $dados->getAbaSelecionada() : App\Libs\DadosView::ABA_GERENCIAR_POSTS;
@endphp
<div class="blog-masthead">
   <div class="container">
     <nav class="blog-nav">
       <a class="blog-nav-item {{ $aba === App\Libs\DadosView::ABA_GERENCIAR_POSTS ? 'active' : ''}}"
                                                  href="{{ route('admin.index')}}">Gerenciar Posts</a>
     <a class="blog-nav-item {{ $aba  === App\Libs\DadosView::ABA_GERENCIAR_CATEGORIAS ? 'active' : ''}}"
                                  href="{{route('admin.listar.categorias')}}">Gerenciar Categorias</a>
       <a class="blog-nav-item {{ $aba  === App\Libs\DadosView::ABA_GERENCIAR_USUARIOS ? 'active' : ''}}"
                                      href="{{route('admin.listar.usuarios')}}">Gerenciar Usuários</a>
     <a class="blog-nav-item" href="{{ route('admin.logout')}}">Sair</a>

     <div class="pull-right">
     <span class="label label-danger">
       {{ Auth::user()->name }}
     </span>
     </div>
     </nav>
   </div>
 </div>
