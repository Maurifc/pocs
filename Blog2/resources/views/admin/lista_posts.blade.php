@extends('layouts.admin')

@section('content')
<div class="container marginTop">
	<ol class="breadcrumb panel-heading">
		<li class="active">{{ $dados->getTituloPagina() }}</li>
	</ol>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{route('admin.cadastrar.post')}}" class="btn btn-primary btn-large">Cadastrar novo post</a>

            <table class="table table-striped table-bordered table-hover marginTop">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th width="200">Data/Hora</th>
                        <th width="40"></th>
                        <th width="40"></th>
                        <th width="40"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->titulo }}</td>
                            <td>{{$post->dataFantasia}}</td>
                            <td>
                                <a href="{{ route('admin.alterar.post', $post->id) }}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
                                <a href="javascript:(confirm('Tem certeza que deseja deletar {{ $post->titulo }} ?')) ?
                                    window.location.href='{{ route('admin.deletar.post', $post->id) }}': void(0)" class="btn btn-danger">Excluir</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.post.imagens', $post->id) }}" class="btn btn-primary">Imagens</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
