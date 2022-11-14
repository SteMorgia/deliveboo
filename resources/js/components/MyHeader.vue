<template>
  <div>
    <header  class="my_header">
      <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
          <a class="navbar-brand mr-10" href="#">Deliveboo</a>
          
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="/register">Registrati</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin">Accedi</a>
            </li>
          </ul>      
      </nav> 

      <div class="MyWrapper">
        <div class="MyOverlay"></div>
          <div class="jumbotron jumbotron-fluid Myjumbotron"></div>
      </div>
    </header>

    <div class="container text_container">
          <h1 class="display-4 text-white">Scegli il tuo piatto</h1>
          <p class="lead text-white">A casa tua con un click.</p>
    </div> 
  </div>
</template>

<script>
  export default {
      name: 'MyHeader'
  }
</script>

<style scoped lang="scss">

  .my_header {
    background-color: #ff8906;
    height: 60px;

    .MyWrapper {
      position: relative;
        
      .Myjumbotron {
          background-image: url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');
          background-size: cover;
          height: 300px;
      }

      .MyOverlay {
        background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      }
    }
  }

  .text_container {
    position: absolute;
    top: 100px;
    left: 0;
  }
</style>