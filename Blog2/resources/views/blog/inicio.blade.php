@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-8 blog-main">
			@foreach($posts as $post)
				@php
					$postLink = route('post.mostrar', $post->id);
				@endphp
				<div class="blog-post">
				    <a href="{{ $postLink }}">
							<h2 class="blog-post-title">{{$post->titulo}}</h2>
						</a>
						<p class="blog-post-meta">{{$post->dataFantasia}} por
												{{$post->usuario->name}}. Categoria:
															<strong>{{$post->categoria->titulo}}</strong></p>

						@if(count($post->imagemDestaque()) === 1)
							<a href="{{ $postLink }}">
								<p><img src="{{ url($post->imagemDestaque()->url()) }}"
										 															width="80%" height="30%"/></p>
							</a>
				    @endif

						<div class="blog-post-text">
								{{str_limit($post->texto, $limit = 150, $end = '...')}}

								<a href="{{ $postLink }}">Ler mais</a>
						</div>
					</a>
			  </div>
		  @endforeach

			<div align="left">
		    	{!! $posts->links() !!}
			</div>
		</div><!-- /.blog-main -->

		<!-- Barra lateral (Sobre e Categorias) -->
		@include('layouts._includes._sidebar')

	</div><!-- /row -->
</div><!-- /container-->
@endsection
