@extends('layouts.admin')

@section('content')
<div class="container">
  <ol class="breadcrumb panel-heading">
    <li><a href="{{ route('admin.listar.usuarios') }}">Gerenciar usuários</a></li>
    <li class="active">{{ $dados->getTituloPagina() }}</li>
  </ol>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $dados->getTituloPagina() }}</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ $dados->getRotaSubmit() }}">
            {{ csrf_field() }}

            @if($dados->getModo() !== 'alterar_senha')
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Login</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $usuario->name or '' }}" required autofocus>

                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('nomeCompleto') ? ' has-error' : '' }}">
              <label for="nomeCompleto" class="col-md-4 control-label">Nome Completo</label>

              <div class="col-md-6">
                <input id="nomeCompleto" type="text" class="form-control" name="nomeCompleto" value="{{ $usuario->nomeCompleto or '' }}" required autofocus>

                @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email or '' }}" required>

                @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
            @endif

            @if(!isset($usuario) || $dados->getModo() === 'alterar_senha')
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label">Senha</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" value="" required>

                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>
            @endif
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  {{ $dados->getLabelBotaoSubmit() }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
