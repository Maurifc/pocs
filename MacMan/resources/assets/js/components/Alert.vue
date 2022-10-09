<template>
  <div id="alert">
    <div v-show="mostrar" class="alert alert-dismissible fade show" :class="type" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span>{{ msg }}</span>
    </div>
  </div>
</template>
<script>
export default {
  name: "alert",
  data: () => ({
    mostrar: false
  }),
  created() {
    this.mostrar = true;
    setTimeout(function () {
      $('.alert').alert('close');
    }, 3000);
  },
  props: ['msg', 'type'],
}
</script>
<style lang="scss" scoped>
</style>
