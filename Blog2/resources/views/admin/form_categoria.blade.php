@extends('layouts.admin')

@section('content')
<div class="container marginTop">
	<ol class="breadcrumb panel-heading">
		<li><a href="{{ route('admin.listar.categorias') }}">Gerenciar categorias</a></li>
		<li class="active">{{$dados->getTituloPagina()}}</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			{{ $dados->getTituloPagina() }}
		</div>
		<div class="panel-body">

			<form method="POST" action="{{ $dados->getRotaSubmit() }}">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-2">
						<strong>Nome da categoria</strong>
					</div>
					<div class="col-xs-10 {{ $errors->has('titulo') ? 'has-error' : ''}}">
						<input type="text" name="titulo" class="col-xs-12 form-control" value="{{ $categoria->titulo or '' }}" autofocus required/>
						@if($errors->has('titulo'))
						<span class="helper-block">
							<strong>{{ $errors->first('titulo') }}</strong>
						</span>
						@endif
					</div>
				</div>

				<div class="row marginTop">
					<div class="col-xs-2">
						<input type="submit" value="{{ $dados->getLabelBotaoSubmit() }}" class="btn btn-primary btn-large" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
