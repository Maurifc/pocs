@extends('layouts.admin')

@section('content')
<div class="container marginTop">
  <ol class="breadcrumb panel-heading">
    <li>{{ $dados->getTituloPagina() }}</li>
  </ol>
    <div class="row">
        <div class="col-xs-12">
            <a href="{{route('admin.cadastrar.usuario')}}" class="btn btn-primary btn-large">Cadastrar novo usuário</a>

            <table class="table table-striped table-bordered table-hover marginTop">
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>Nome Completo</th>
                        <th>E-mail</th>
                        <th width="40"></th>
                        <th width="40"></th>
                        <th width="40"></th>
                        <th width="40"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->nomeCompleto }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                <a href="{{ route('admin.alterar.usuario', $usuario->id) }}" class="btn btn-primary">Alterar</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.alterar.senha.usuario', $usuario->id) }}" class="btn btn-primary">Alterar Senha</a>
                            </td>
                            <td>
                              {{-- Se o usuário possui algum post, ele não pode ser excluído, somente desativado. --}}
                              @if($usuario->desativado === 0)
                                <a href="javascript:(confirm('Tem certeza que deseja desativar {{ $usuario->name }} ?')) ?
                                    window.location.href='{{ route('admin.desativar.usuario', $usuario->id)}}': void(0)" class="btn btn-danger">Desativar</a>
                              @else
                                <a href="{{route('admin.reativar.usuario', $usuario->id)}}" class="btn btn-success" style="width: 100%">Ativar</a>
                              @endif
                            </td>
                            <td>
                              @if($usuario->posts()->count() > 0)
                                <a href="#" onclick="return false" class="btn btn-danger" disabled>Excluir</a>
                              @else
                              <a href="javascript:(confirm('Tem certeza que deseja deletar {{ $usuario->name }} ?')) ?
                                  window.location.href='{{ route('admin.excluir.usuario', $usuario->id)}}': void(0)" class="btn btn-danger">Excluir</a>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</div>
@endsection
