<template>

  <div class="container-fluid my-container text-center">

    <h1>Pagina non trovata!</h1>

    <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>
    
  </div>

</template>

<script>

export default {
    name: 'NotFound',
}

</script>

<style lang='scss' scoped>

</style>