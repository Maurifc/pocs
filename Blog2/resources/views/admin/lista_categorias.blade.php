@extends('layouts.admin')

@section('content')
<div class="container marginTop">
  <ol class="breadcrumb panel-heading">
    <li class="active">Gerenciar categorias</li>
  </ol>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{route('admin.cadastrar.categoria')}}" class="btn btn-primary btn-large">Cadastrar nova categoria</a>

            <table class="table table-striped table-bordered table-hover marginTop">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th width="40"></th>
                        <th width="40"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->titulo }}</td>
                            <td>
                                <a href="{{ route('admin.alterar.categoria', $categoria->id)}}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
                                <a href="javascript:(confirm('Tem certeza que deseja deletar {{ $categoria->titulo }} ?')) ?
                                    window.location.href='{{route('admin.deletar.categoria', $categoria->id)}}': void(0)" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
