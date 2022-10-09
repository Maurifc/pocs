<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <router-link to="/computadores" class="navbar-brand" href="#">MacMan</router-link>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav" v-show="$can('admin')">
          <router-link tag="li" to="/computadores" class="nav-item" exact>
            <a class="nav-link">Computadores</a>
          </router-link>
          <router-link tag="li" to="/licencas" class="nav-item" exact>
            <a class="nav-link">Licenças</a>
          </router-link>
          <router-link tag="li" to="/clientes" class="nav-item" exact>
            <a class="nav-link">Clientes</a>
          </router-link>
        </ul>
        <ul class="navbar-nav ml-auto" v-show="$can('admin')">
          <li class="nav-item">
            <a class="nav-link" @click="logout">Sair</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- <alert msg="Login realizado com sucesso!" type="alert-success"></alert> -->

    <router-view></router-view>

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
