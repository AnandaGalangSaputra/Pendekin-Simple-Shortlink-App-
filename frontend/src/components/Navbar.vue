<template>
  <div class="navbar bg-base-100">
    <div class="flex-1">
      <router-link to="/">
      <a class="btn btn-ghost text-2xl md:text-3xl font-extrabold text-blue-600">Pendekin.com</a>
      </router-link>
    </div>

    <!-- Menu untuk desktop -->
    <div class="hidden md:flex gap-6 font-medium items-center">
      <router-link to="/" class="hover:text-blue-600 transition">Home</router-link>
      <router-link to="/ListLink" class="hover:text-blue-600 transition">ListLink</router-link>
    </div>

    <!-- Dropdown menu untuk mobile -->
    <div class="dropdown md:hidden">
      <label tabindex="0" class="btn btn-ghost">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </label>
      <ul tabindex="0"
        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-40">
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/ListLink">ListLink</router-link></li>
      </ul>
    </div>
    <div class="">
      <ThemeToggle />
    </div>
  </div>
</template>


<script setup>
import ThemeToggle from './ThemeToggle.vue';
</script>