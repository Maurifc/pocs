@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <ol class="breadcrumb panel-heading">
        <li><a href="{{ route('post.index') }}">Início</a></li>
        <li class="active">Contato</li>
      </ol>
        <form role="form" action="{{ route('contato.enviaremail')}}" method="post" >
            <div class="col-lg-6">
              {{ csrf_field() }}

                @if(Session::Has('flash_message'))
                  <div class="alert {{ Session::get('flash_message')['class'] }}">
                    {{ Session::get('flash_message')['msg'] }}
                  </div>
                @endif

                <div class="well well-sm">
                    <strong>* = Campo obrigatório</strong>
                </div>

                <div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
                    <label for="InputName">Seu nome:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="nome" placeholder="Digite o seu nome" required>
                        <span class="input-group-addon">*</span>
                    </div>
                    @if($errors->has('nome'))
                      <span class="help-block">
                        <strong>{{ $errors->first('nome') }}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="InputEmail">Seu e-mail:</label>
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" placeholder="Digite o seu e-mail" required>
                        <span class="input-group-addon">*</span>
                    </div>
                    @if($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email')}}</strong>
                      </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('mensagem') ? 'has-error' : '' }}">
                    <label for="InputMessage">Mensagem:</label>
                    <div class="input-group">
                        <textarea name="mensagem" class="form-control" rows="5" required></textarea>
                        <span class="input-group-addon">*</span>
                    </div>
                    @if($errors->has('mensagem'))
                      <span class="help-block">
                        <strong>{{ $errors->first('mensagem') }}</strong>
                      </span>
                    @endif
                </div>
                <input type="submit" name="submit" id="submit" value="Enviar" class="btn btn-info">
            </div>
        </form>

    </div>

</div>
@endsection
