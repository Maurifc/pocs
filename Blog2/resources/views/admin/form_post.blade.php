@extends('layouts.admin')

@section('content')
<div class="container marginTop">
	<ol class="breadcrumb panel-heading">
		<li><a href="{{ route('admin.index') }}">Gerenciar posts</a></li>
		<li class="active">{{ $dados->getTituloPagina() }}</li>
	</ol>
	@if(isset($post))
	<div class="row">
		<div class="col-xs-12">
			<div class="alert alert-info">
				Post criado em {{ $post->dataFantasia }} por {{ $post->usuario->name }}.
			</div>
		</div>
	</div>
	@endif
<div class="panel panel-default">
	<div class="panel-heading">
		{{ $dados->getTituloPagina() }}
	</div>
	<div class="panel-body">

			<form method="POST" action="{{ $dados->getRotaSubmit() }}">
				{{ csrf_field() }}
				<div class="row">
					<div class="col-xs-2">
							<strong>Título do post</strong>
					</div>
					<div class="col-xs-10 {{ $errors->has('titulo') ? 'has-error' : ''}}">
							<input type="text" name="titulo" class="col-xs-12 form-control" value="{{ $post->titulo or '' }}" autofocus required/>
					</div>
				</div>

				<div class="row marginTop">
					<div class="col-xs-2">
							<strong>Data:</strong>
					</div>
					<div class="col-xs-10 {{ $errors->has('dataFantasia') ? 'has-error' : ''}}">
							@php
								if(isset($post)){
									$data = new DateTime($post->dataFantasia);
								} else {
									$data = new DateTime('');
								}
							@endphp
							<input type="text" name="dataFantasia" class="col-xs-12 form-control" value="{{ $data->format('d/m/Y H:i') }}" placeholder="00/00/0000 00:00" required/>
					</div>
				</div>

				<div class="row marginTop">
					<div class="col-xs-2">
							<strong>Texto Completo:</strong>
					</div>
					<div class="col-xs-10 {{ $errors->has('texto') ? 'has-error' : ''}}">
						<textarea name="texto" class="col-xs-12 form-control" required>{{ $post->texto or ''}}</textarea>
					</div>
				</div>

				<div class="row marginTop">
					<div class="col-xs-2">
							<strong>Bloqueado?</strong>
					</div>
					<div class="col-xs-10">
						<label>
							<input type="radio" name="bloqueado" value="1" {{ (isset($post) && $post->bloqueado === 1) ? 'checked' : ''}}> Sim
						</label>
						<label>
							<input type="radio" name="bloqueado" value="0" {{ (!isset($post) || (isset($post) && $post->bloqueado === 0)) ? 'checked' : ''}}> Não
						</label>
					</div>
				</div>

				<div class="row marginTop">
					<div class="col-xs-2">
							<strong>Categoria:</strong>
					</div>
					<div class="col-xs-10">
						<select name="categoria" class="form-control">
							@foreach($categorias as $categoria)
								    <option value="{{$categoria->id}}" {{ isset($post) && ($categoria->id === $post->categoria->id) ?
		                      'selected="selected"' : '' }} >{{$categoria->titulo}}</option>
							@endforeach
						</select>
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
<br/>
<br/>
<br/>
@endsection
