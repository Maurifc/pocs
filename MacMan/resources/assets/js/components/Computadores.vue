<template>
  <div id="computadores">
    <div class="container bg-white">
      <div class="row">
        <div class="col-sm-12">
          <!-- Título -->
          <h3>Computadores</h3>
          <hr>
          <br>
        </div>
      </div>

      <!-- Select de clientes -->
      <div class="form-group row">
        <label for="cliente-select" class="col-sm-1">Cliente:</label>
        <select id="cliente-select" class="custom-select col-sm-3" v-on:change="carregarCliente($event)">
          <option v-for="cliente in clientes" value="cliente.cliente_id">{{cliente.nome}}</option>
        </select>
      </div>

    </div> <!-- /.Container -->

  </div>
</template>
<script>
export default {
  name: "computadores",
  data: () => ({
    clientes: [{nome: 'Nenhum'}]
  }),
  methods: {
    carregarListaClientes(){
      let self = this;
      axios.get('/api/clientes')
      .then(function (response) {

        self.clientes = response.data;
      });
    },
    carregarCliente(e) {
      let self = this;
      var clienteId = e.target.value;
      axios.get('/api/clientes' + clienteId)
      .then(function (response) {
        // TODO: Implementar método para carregar computadores de um cliente
      })
    }
  },
  created() {
    this.carregarListaClientes();
  }
}
</script>
<style lang="scss" scoped>
</style>
