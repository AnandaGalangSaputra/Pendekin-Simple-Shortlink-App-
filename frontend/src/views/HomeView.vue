<script setup>
import { ref } from "vue"
import axios from "axios"

const longUrl = ref("")
const shortName = ref("")
const errorMsg = ref("")
const showAlert = ref(false)
const showModal = ref(false)
const shortUrl = ref("") 
const loading = ref(false)

const handleSubmit = async () => {
  if (!longUrl.value || !shortName.value) {
    errorMsg.value = "URL panjang dan nama shortlink harus diisi!"
    showAlert.value = true
    setTimeout(() => (showAlert.value = false), 3000)
    return
  }

  try {
    loading.value = true
    const res = await axios.post("http://127.0.0.1:8000/api/shortlinks", {
      long_url: longUrl.value,
      short_name: shortName.value,
    })

    shortUrl.value = res.data.data.short_url
    showModal.value = true

    longUrl.value = ""
    shortName.value = ""
  } catch (err) {
    errorMsg.value = err.response?.data?.error || "Terjadi kesalahan!"
    showAlert.value = true
    setTimeout(() => (showAlert.value = false), 3000)
  } finally {
    loading.value = false
  }
}

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(shortUrl.value)
    alert("Link berhasil disalin!")
  } catch (e) {
    console.error("Gagal menyalin link:", e)
  }
}
</script>

<template>
  <div class="min-h-screen flex flex-col md:flex-row items-center px-6 md:px-16 dark:bg-gray-900 dark:text-white transition-colors duration-300">
    <!-- Kiri -->
    <div class="w-full md:w-1/2">
      <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-tight text-center md:text-left">
        Pendekin Tautan
        <span class="text-blue-600">Panjangmu</span>
        Dengan
        <span class="text-blue-600">Pendekin.</span>
      </h1>

      <!-- Input Long URL -->
      <div class="mt-6 md:mt-8">
        <input
          v-model="longUrl"
          type="text"
          placeholder="Masukkan tautan panjangmu disini..."
          class="w-full p-4 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
        />
      </div>

      <!-- Input Short Name -->
      <div class="mt-4">
        <div class="flex flex-col md:flex-row rounded-2xl border border-gray-300 dark:border-gray-700 overflow-hidden shadow-sm">
          <span class="px-4 py-3 bg-blue-600 text-white font-semibold select-none text-center md:text-left">
            https://pendekin/
          </span>
          <input
            v-model="shortName"
            type="text"
            placeholder="Nama Link Kamu"
            class="flex-1 p-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 outline-none"
          />
        </div>
        <p class="mt-2 text-xs md:text-sm text-gray-500 dark:text-gray-400 text-center md:text-left">
          Contoh hasil: https://pendekin/galang
        </p>
      </div>

      <!-- Alert Error -->
      <transition name="fade">
        <div v-if="showAlert" class="alert alert-error mt-4 transition-opacity duration-500 text-sm">
          <span>{{ errorMsg }}</span>
        </div>
      </transition>

      <!-- Button -->
      <div class="mt-6 md:mt-8 flex justify-center md:justify-start">
        <button
          @click="handleSubmit"
          :disabled="loading"
          class="flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl px-6 md:px-8 py-3 md:py-4 transition w-full md:w-auto disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <span v-if="!loading">Pendekin</span>
          <span v-else class="loading loading-spinner"></span>
          <svg v-if="!loading" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2 21L23 12 2 3l5 9-5 9z" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Kanan -->
    <div class="w-full md:w-1/2 hidden md:flex justify-center p-10">
      <img src="@/assets/HeroImage.svg" alt="Hero Image" class="w-4/5 max-w-lg" />
    </div>
  </div>

  <!-- Modal -->
  <div v-if="showModal" class="modal modal-open">
    <div class="modal-box relative bg-white dark:bg-gray-800 dark:text-white shadow-xl border border-base-200 w-11/12 max-w-lg">
      <!-- Tombol Close -->
      <button class="btn btn-sm btn-circle absolute right-2 top-2" @click="showModal = false">✕</button>

      <!-- Judul -->
      <h2 class="font-bold text-xl md:text-2xl text-primary text-center md:text-left">
        Shortlink Berhasil Dibuat
      </h2>
      <p class="text-xs md:text-sm text-gray-600 dark:text-gray-300 mt-1 text-center md:text-left">
        Link akan kedaluwarsa dalam <strong>12 jam</strong>.
      </p>

      <!-- Link -->
      <div class="mt-5">
        <input type="text" :value="shortUrl" readonly class="input input-bordered w-full text-xs md:text-sm dark:bg-gray-700 dark:text-white" />
      </div>

      <!-- Actions -->
      <div class="modal-action flex justify-center md:justify-end">
        <a :href="shortUrl" target="_blank" class="btn btn-primary w-full md:w-auto">Open</a>
        <button class="btn w-full md:w-auto" @click="copyLink">Salin</button>
      </div>
    </div>
  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
