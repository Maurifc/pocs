@php
  //Define a aba padrão como ABA_BLOG caso nenhuma aba tenha sido enviada para a view
  $aba = (isset($dados) && $dados->getAbaSelecionada() !== null) ?
                $dados->getAbaSelecionada() : App\Libs\DadosView::ABA_BLOG;
@endphp
<a class="blog-nav-item {{ $aba == App\Libs\DadosView::ABA_BLOG ? 'active' : ''}}" href="{{ route('post.index') }}">Inicial</a>
<a class="blog-nav-item {{ $aba == App\Libs\DadosView::ABA_FALE_CONOSCO ? 'active' : ''}}" href="{{ route('contato.form') }}">Fale Conosco</a>
