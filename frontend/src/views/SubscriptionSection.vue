<script setup>
import PriceCard from "../components/PriceCard.vue";

const plans = [
  {
    title: "Gratis",
    description: "Cocok untuk mencoba layanan",
    price: "Rp0",
    features: [
      { name: "100 Link", included: true },
      { name: "Masa aktif 12 jam", included: true },
      { name: "Custom Domain", included: true },
      { name: "Statistik Dasar", included: true },
      { name: "Tanpa Fitur Lanjutan", included: false },
    ],
    highlighted: false,
    buttonText: "Gunakan Gratis",
  },
  {
    title: "Medium",
    description: "Untuk pengguna aktif",
    price: "Rp29.000/bln",
    features: [
      { name: "1.000 Link per bulan", included: true },
      { name: "Custom Domain", included: true },
      { name: "Statistik Lengkap", included: true },
      { name: "Support via Email", included: true },
    ],
    highlighted: true,
    buttonText: "Pilih Medium",
  },
  {
    title: "Premium",
    description: "Tanpa batasan, untuk profesional",
    price: "Rp99.000/bln",
    features: [
      { name: "Link tanpa batas", included: true },
      { name: "Custom Domain", included: true },
      { name: "Statistik Lanjutan", included: true },
      { name: "Backup & Keamanan", included: true },
      { name: "Dukungan Prioritas", included: true },
    ],
    highlighted: false,
    buttonText: "Pilih Premium",
  }
];


</script>

<template>
  <!-- Grid responsive -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 py-10 max-w-6xl mx-auto">
    <PriceCard
      v-for="(plan, i) in plans"
      :key="i"
      v-bind="plan"
    />
  </div>
</template>