<template>
  <label class="flex cursor-pointer gap-2 ml-4 items-center">
    <!-- Sun icon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
      viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="5" />
      <path d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4"/>
    </svg>

    <!-- Toggle -->
    <input
      type="checkbox"
      class="toggle"
      :checked="theme === 'dark'"
      @change="toggleTheme"
    />

    <!-- Moon icon -->
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
      viewBox="0 0 24 24" fill="none" stroke="currentColor"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
    </svg>
  </label>
</template>

<script>
export default {
  name: "ThemeToggle",
  data() {
    return {
      theme: localStorage.getItem("theme") || "light", // default light
    };
  },
  mounted() {
    // Set initial theme saat component dipasang
    document.documentElement.setAttribute("data-theme", this.theme);
  },
  methods: {
    toggleTheme() {
      this.theme = this.theme === "light" ? "dark" : "light";
      document.documentElement.setAttribute("data-theme", this.theme);
      localStorage.setItem("theme", this.theme);
    },
  },
};
</script>
