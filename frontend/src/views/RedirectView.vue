<script setup>
import { onMounted } from "vue"
import { useRoute, useRouter } from "vue-router"
import axios from "axios"

const route = useRoute()
const router = useRouter()

onMounted(async () => {
  try {
    const short = route.params.short
    const res = await axios.get(`http://127.0.0.1:8000/api/shortlinks`) 

    const item = res.data.find(i => i.short_name === short)

    if (!item) {
      alert("Link tidak ditemukan!")
      router.push("/") // balik ke home
      return
    }

    // cek expired
    if (new Date() > new Date(item.expired_at)) {
      alert("Link sudah expired!")
      router.push("/")
      return
    }

    // redirect ke long_url
    window.location.href = item.long_url
  } catch (err) {
    console.error(err)
    alert("Terjadi error!")
    router.push("/")
  }
})
</script>

<template>
  <div class="flex h-screen items-center justify-center">
    <p class="text-lg text-gray-600">Sedang mengarahkan...</p>
  </div>
</template>
