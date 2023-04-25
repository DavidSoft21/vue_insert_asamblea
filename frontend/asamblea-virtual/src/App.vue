<script setup>
import NavComponent from "./components/NavComponent.vue";
import FooterComponent from "./components/FooterComponent.vue";
</script>
<template>
  <div id="app" class="container-fluid">
    <header >
      <NavComponent />
    </header>

    <main class="bd-content p-3" role="main">
      <div class="row">
        <div class="col-sm d-flex justify-content-center">
          <router-view />
        </div>
      </div>
    </main>

    <footer id="footer" class="bg-dark text-white d-flex-column text-center">
      <FooterComponent />
    </footer>
  </div>
</template>
<style scoped>
#app {
  height: 100vh;
}

footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}
</style>
