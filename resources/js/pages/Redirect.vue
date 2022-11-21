<template>
  <div class="container-fluid my-container">
    <h1>Grazie dell'acquisto!</h1>
    <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>
  </div>
</template>

<script>
export default {
  name: 'Redirect'

}
</script>

<style scoped lang="scss">
  .my-container {
    height: 100vh;
  }

</style>