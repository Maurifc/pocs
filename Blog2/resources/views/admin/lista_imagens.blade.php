@extends('layouts.admin')

@section('content')
<div class="container marginTop">
	<ol class="breadcrumb panel-heading">
		<li><a href="{{ route('admin.index') }}">Gerenciar posts</a></li>
		<li class="active">Imagens de {{ $post->titulo }}</li>
	</ol>
	<div class="row">
		<div class="col-xs-12">
			<a href="{{route('admin.upload.imagem', $post->id)}}" class="btn btn-primary btn-large">Cadastrar nova imagem</a>

			<table class="table table-striped table-bordered table-hover marginTop">
				<thead>
					<tr>
						<th width="40">Imagem</th>
						<th>Legenda</th>
						<th width="40"></th>
						<th width="40"></th>
					</tr>
				</thead>
				<tbody>

					@foreach($post->imagens as $imagem)
					<tr>
						<td><img src="{{$imagem->urlSm()}}" width="100%" /></td>
						<td>{{$imagem->legenda}}</td>
						<td>
							<a href="{{ route('admin.alterar.imagem', $imagem->id)}}" class="btn btn-primary">Alterar</a>
						</td>
						<td>
							<a href="javascript:(confirm('Tem certeza que deseja deletar {{ $imagem->legenda }} ?')) ?
									window.location.href='{{ route('admin.remover.imagem', $imagem->id) }}': void(0)" class="btn btn-danger">Excluir</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
@endsection
