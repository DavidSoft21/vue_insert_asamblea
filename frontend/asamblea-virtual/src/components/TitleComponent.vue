<script setup>
defineProps({
  title: {
    type: String,
    required: true,
  },
});
</script>

<template>
    <div>
        <h1 class="title text-center">
            {{ title }}
        </h1>
    </div>
</template>

<style>


</style>