<template>
  <div
    class="card bg-base-100 shadow-md transition-transform duration-300 w-full"
    :class="[
      highlighted
        ? 'w-96 scale-110 z-10 border-2 border-blue-600 hover:scale-115 shadow-xl'
        : 'w-80 hover:scale-105'
    ]"
  >
    <div class="card-body">
      <span v-if="highlighted" class="badge badge-warning w-fit">Most Popular</span>
      <h2 class="text-2xl font-bold">{{ title }}</h2>
      <p v-if="description" class="text-sm opacity-70">{{ description }}</p>
      <span class="text-xl mt-2 font-semibold">{{ price }}</span>

      <ul class="mt-4 text-sm space-y-1">
        <li
          v-for="(feature, i) in features"
          :key="i"
          :class="feature.included ? '' : 'line-through opacity-50'"
        >
          <span v-if="feature.included">✔</span>
          <span v-else>✘</span>
          {{ feature.name }}
        </li>
      </ul>

      <button
        class="btn mt-4"
        :class="
          highlighted
            ? 'bg-blue-600 text-white hover:bg-blue-700 btn-block'
            : 'border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white'
        "
      >
        {{ buttonText }}
    </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  description: String,
  price: String,
  features: {
    type: Array,
    default: () => [],
  },
  highlighted: {
    type: Boolean,
    default: false,
  },
  buttonText: {
    type: String,
    default: "Choose",
  },
});
</script>
