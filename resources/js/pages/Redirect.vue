<template>

  <div class="container-fluid my-container text-center">

    <h1>Grazie dell'acquisto!</h1>

    <router-link :to="{name: 'homepage'}" class="btn mt-3" style="background-color:#ff8906;" >Torna alla homepage</router-link>
    
    <MyFooter />

  </div>

</template>

<script>
import MyFooter from '../components/MyFooter.vue';

export default {
  name: 'Redirect',
  components: {
    MyFooter
  }
}
</script>

<style scoped lang="scss">

  .my-container {
    height: 100vh;
  }

</style>