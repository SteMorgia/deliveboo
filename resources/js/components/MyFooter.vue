<template>

  <!-- Footer -->
  <footer class="text-center text-lg-start  text-muted MyFooter" style="height: 100%;">
    
    <!-- Section: Links  -->
    <section>
      <div class="container text-center text-md-start">
        <!-- Grid row -->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 mt-5 links rounded">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4 font-weight-bold">
              DeliveBoo
            </h6>
            <p>
              I piatti dei ristoranti che ami.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 mt-5 links rounded" >
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 font-weight-bold">
              Discover Deliveroo
            </h6>
            <p>
              <a href="/" class="text-reset">Ristoranti</a>
            </p>
            <p>
              <a href="#" class="text-reset">Piatti</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Takeaway</a>
            </p>
            <p>
              <a href="#!" class="text-reset">FastFood</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 mt-5 links rounded">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 font-weight-bold">
              Note legali
            </h6>
            <p>
              <a href="#!" class="text-reset">Termini & Condizioni</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Informativa sulla privacy</a>
            </p>
            <p>
              <a href="#!" class="text-reset">Cookies</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto  mb-4 mt-5 links rounded">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 font-weight-bold">Aiuto</h6>
            <p><a href="#!" class="text-reset">Contatti</a></p>
            <p><a href="#!" class="text-reset">FAQs</a></p>
            <p><a href="#!" class="text-reset">Tipi di cucina</a></p>
          </div>
          <!-- Grid column -->

        </div>
          <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4 d-flex justify-content-between"   style="background-color: rgb(46, 51, 51) links">
      <span style="color: #ff8906;">We &hearts; Orange</span>
      <div>
        <a class="text-reset fw-bold" href="#">
          <span class="bali">Team 4 © 2022</span>
        </a>
      </div>
    </div>
    
  </footer>
</template>

<script>
export default {
    name: 'MyFooter'
}
</script>

<style lang="scss" scoped>

  .links {
    background-color: rgb(208, 208, 206);
    padding-top: 2rem;
      color: black;
    
    :hover {
      color: #e53170;
      text-decoration: none;
      cursor: pointer;
    }
  }

  .MyFooter{
    background-color: #0f0e17 
  }

  .bali {
    
    color: #ff8906;
  }

</style>