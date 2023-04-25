<script setup>
import JumbotronComponent from "../components/JumbotronComponent.vue";
import TitleComponent from "../components/TitleComponent.vue";
import dataTableComponent from "../components/dataTableComponent.vue";
</script>
<template>
  <div class="children">
    <div id="contenido">
      <TitleComponent title="Inicio" />
      <JumbotronComponent />
    </div>
  </div>
</template>
<style scoped>
#contenido {
  margin: auto;
  width: 100% ;
}
</style>
