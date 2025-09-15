<template>
  <nav class="bg-white dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
      <!-- Logo + Brand -->
      <a href="/" class="flex items-center space-x-2">
        <img 
          src="https://flowbite.com/docs/images/logo.svg" 
          class="h-8" 
          alt="Logo"
        />
        <span class="text-2xl font-bold text-gray-900 dark:text-white">
          Pendekin
        </span>
      </a>

      <!-- Hamburger (mobile) -->
      <button 
        data-collapse-toggle="navbar-default" 
        type="button"
        class="md:hidden inline-flex items-center p-2 w-10 h-10 justify-center text-gray-600 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800"
        aria-controls="navbar-default" 
        aria-expanded="false"
      >
        <span class="sr-only">Open main menu</span>
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Menu -->
      <div class="hidden md:block" id="navbar-default">
        <ul class="flex flex-col md:flex-row md:space-x-8 font-medium">
          <li>
            <a href="#" class="block py-2 px-3 text-white bg-blue-600 rounded-md md:bg-transparent md:text-blue-600 md:p-0 dark:text-white md:dark:text-blue-500">
              Home
            </a>
          </li>
          <li>
            <a href="#" class="block py-2 px-3 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-gray-300 dark:hover:text-blue-400">
              About
            </a>
          </li>
          <li>
            <a href="#" class="block py-2 px-3 text-gray-700 rounded-md hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-600 md:p-0 dark:text-gray-300 dark:hover:text-blue-400">
              Contact
            </a>
          </li>
        </ul>
      </div>

      <!-- Button Action -->
      <div class="hidden md:block">
        <button class="btn btn-primary rounded-full px-6">
          Get Started
        </button>
      </div>
    </div>
  </nav>
</template>
