<script setup>
import { ref, onMounted } from "vue"
import axios from "axios"

const ListLink = ref([])
const loading = ref(true)   // awalnya true
const error = ref(null)

const fetchList = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/getlist")
    ListLink.value = res.data
  } catch (err) {
    error.value = err.response?.data?.error || "Terjadi kesalahan!"
    console.error(err)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchList()
})
</script>

<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 px-4 md:px-16 py-10">
    <!-- Loading overlay -->
    <div v-if="loading" class="fixed inset-0 flex items-center justify-center bg-black/40 z-50">
      <span class="loading loading-dots loading-xl text-white"></span>
    </div>

    <!-- Error -->
    <div v-else-if="error" class="text-red-600 text-center font-semibold">
      {{ error }}
    </div>

    <!-- No data -->
    <div v-else-if="ListLink.length === 0" class="text-gray-600 text-center font-medium">
      Tidak ada data tersedia.
    </div>

    <!-- Content -->
    <div v-else class="max-w-6xl mx-auto space-y-8">
      <!-- Heading -->
      <h1
        class="text-3xl md:text-5xl  font-extrabold text-gray-900 dark:text-white leading-tight text-center md:text-left">
        Cuma disini <br>
        <span class="text-blue-600">FREE</span>
        dan Ga
        <span class="text-blue-600">Kikir.</span>
      </h1>

      <!-- Table -->
      <div class="overflow-x-auto bg-white dark:bg-gray-800  shadow-md">
        <table class="table w-full text-sm md:text-base">
          <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <tr>
              <th class="px-4 py-3">Short Name</th>
              <th class="px-4 py-3">Short URL</th>
              <th class="px-4 py-3">Long URL</th>
              <th class="px-4 py-3">Created At</th>
              <th class="px-4 py-3">Expired At</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="item in ListLink"
              :key="item.short_name"
              class="hover:bg-gray-50 dark:hover:bg-gray-700"
            >
              <td class="px-4 py-2 font-medium">{{ item.short_name }}</td>
              <td class="px-4 py-2 text-blue-600">
                <a :href="item.short_url" target="_blank">{{ item.short_url }}</a>
              </td>
              <td class="px-4 py-2 truncate max-w-[200px]">
                <a :href="item.long_url" target="_blank" class="text-blue-500 underline">
                  {{ item.long_url }}
                </a>
              </td>
              <td class="px-4 py-2">{{ item.created_at }}</td>
              <td class="px-4 py-2">{{ item.expired_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
