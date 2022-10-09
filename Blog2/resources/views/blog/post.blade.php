@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-8 blog-main">
      <ol class="breadcrumb panel-heading">
        <li><a href="{{ route('post.index') }}">Início</a></li>
        <li class="active">{{ $post->titulo }}</li>
      </ol>
      <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->titulo }}</h2>
        <p class="blog-post-meta">{{ $post->dataFantasia }} por {{$post->usuario->name}}. Categoria: <strong>{{$post->categoria->titulo}}</strong></p>

        @if(count($post->imagemDestaque()) === 1)
          <p><img src="{{ url($post->imagemDestaque()->url()) }}" width="80%" height="30%"/></p>
        @endif

        <div class="blog-post-text">
          {{ $post->texto }}
        </div>

        @if(count($post->imagens) > 0)
          @foreach($post->imagens as $imagem)
          <a href="{{ url($imagem->url()) }}" target="_blank">
            <img src="{{ url($imagem->urlMd()) }}" width="180px" align="center" style="margin:10px;">
          </a>
          @endforeach
        @endif
      </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->

    <!-- Barra lateral (Sobre e Categorias) -->
    @include('layouts._includes._sidebar')

  </div><!-- /.row -->
</div><!-- /.container -->
@endsection
