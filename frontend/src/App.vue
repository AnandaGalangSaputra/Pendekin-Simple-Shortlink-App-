<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Navbar from './components/Navbar.vue'

</script>

<template>
  <div id="app" class="container px-40 mx-auto">
    <Navbar/>
    <RouterView />
    <!-- <HelloWorld msg="Welcome to Your Vue.js + Vite App" /> -->
  </div>
</template>


<style scoped>

</style>