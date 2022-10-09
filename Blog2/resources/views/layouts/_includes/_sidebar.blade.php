<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <h4>Sobre</h4>
      <p>Fale um pouco sobre você</p>
    </div>
    <div class="sidebar-module">
      <h4>Categorias</h4>

      <ol class="list-unstyled">
        @foreach($categorias as $categoria)
          <li><a href="{{ route('post.categoria', $categoria->id)}}">{{$categoria->titulo}}</a></li>
        @endforeach
          <li><a href="{{ route('post.index') }}">Todas</a></li>
      </ol>
    </div>
</div><!-- /.blog-sidebar -->
