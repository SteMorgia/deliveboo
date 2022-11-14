<template>
    <header  class="my_header">
      <nav class="navbar navbar-expand-lg navbar-light justify-content-between align-items-center">
          <a class="navbar-brand" href="/">Deliveboo</a>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="navbar-brand" href="/register">Registrati</a>
            </li>
            <li class="nav-item">
              <a class="navbar-brand" href="/admin">Accedi</a>
            </li>
          </ul>      
      </nav> 
    </header>
</template>

<script>
  export default {
      name: 'MyHeader'
  }
</script>

<style scoped lang="scss">

  .my_header {
    background-color: #ff8906;

    .navbar {
      height: 60px;
    }

    :hover {
      color: white;
    }
  }

</style>