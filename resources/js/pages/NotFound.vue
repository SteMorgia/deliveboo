<template>

  <div class="container-fluid my-container d-flex justify-content-center align-items-center text-center">

    <span> Pagina non trovata! </span>

    <router-link :to="{name: 'homepage'}" class="btn my-btn" style="background-color:#ff8906;" >Torna alla homepage</router-link>
  </div>

</template>

<script>

export default {
  name: 'NotFound'
}
</script>

<style scoped lang="scss">

  .my-container {
    height: 100vh;

    span {
      font-size: 3em;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      background-image: linear-gradient(#ff8906,#ff8906);
      background-size: 100% 10px;
      background-repeat: no-repeat;
      background-position: 100% 0%;
      transition: background-size .7s, background-position .5s ease-in-out;
      border-radius: 5px;
    }

    .my-btn {
      margin-top: 100px;
    }
  }

</style>