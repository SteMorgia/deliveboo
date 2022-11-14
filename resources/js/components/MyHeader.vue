<template>
  <header class="my_header">
    <nav class="navbar navbar-expand-lg navbar-light ">
      <a class="navbar-brand mr-10" href="#">Deliveboo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/register">Registrati</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin">Accedi</a>
          </li>
        </ul>
      </div>
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
  }
</style>