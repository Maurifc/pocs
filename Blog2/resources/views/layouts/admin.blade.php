<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($dados) ? $dados->getTituloPagina() :
                                              'Painel de administração' }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

  </head>
  <body>
  <!--Barra de navegação -->
  @include('layouts._includes._navbar_admin');

  @if(Session::has('flash_message'))
  	<div class="container">
  		<div class="row">
  			<div class="col-xs-10 col-xs-offset-1">
  				<div class="alert {{ Session::get('flash_message')['class'] }}">
  					<p class="text-center">{{ Session::get('flash_message')['msg']}}</p>
  				</div>
  			</div>
  		</div>
  	</div>
  @endif

  @yield('content')

	 <div class="blog-footer">
		<p>Rodapé da pagina</p>
	 </div>
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
