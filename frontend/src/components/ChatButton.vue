<template>
  <div>
    <!-- Tombol Buka Chat (Floating Button) -->
    <div class="fixed bottom-4 right-4 z-999">
      <button
        @click="toggleChatbox"
        class="w-14 h-14 flex items-center justify-center rounded-full bg-blue-500 text-white shadow-lg hover:bg-blue-600 transition duration-300"
      >
        <!-- Icon chat -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8-1.34 0-2.61-.26-3.72-.73L3 20l1.24-2.48C3.45 16.15 3 14.62 3 13c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
      </button>
    </div>

    <!-- Chatbox -->
    <div v-if="isChatboxOpen" class="fixed bottom-20 right-4 w-96 z-999">
      <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg max-w-lg w-full border border-gray-200 dark:border-gray-700">
        
        <!-- Header -->
        <div class="p-4 border-b bg-blue-500 text-white rounded-t-lg flex justify-between items-center">
          <p class="text-lg font-semibold">Admin Bot</p>
          <button @click="toggleChatbox" class="hover:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <!-- Chat Messages -->
        <div ref="chatbox" class="p-4 h-80 overflow-y-auto">
          <div
            v-for="(msg, index) in messages"
            :key="index"
            :class="['mb-2', msg.sender === 'user' ? 'text-right' : 'text-left']"
          >
            <p
              :class="[
                'rounded-lg py-2 px-4 inline-block',
                msg.sender === 'user'
                  ? 'bg-blue-500 text-white'
                  : 'bg-gray-200 dark:bg-gray-700 dark:text-gray-100 text-gray-700'
              ]"
            >
              {{ msg.text }}
            </p>
          </div>
        </div>

        <!-- Input -->
        <div class="p-4 border-t flex dark:border-gray-700">
          <input
            v-model="userInput"
            @keyup.enter="sendMessage"
            type="text"
            placeholder="Type a message"
            class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white"
          />
          <button
            @click="sendMessage"
            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300"
          >
            Send
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from "vue";

const isChatboxOpen = ref(false);
const userInput = ref("");
const messages = ref([
    { sender: "user", text: "Hai Atmint" },
    { sender: "bot", text: "Ini adalah pesan otomatis bot." },
]);

const chatbox = ref(null);

function toggleChatbox() {
    isChatboxOpen.value = !isChatboxOpen.value;
}

function addUserMessage(message) {
    messages.value.push({ sender: "user", text: message });
    scrollToBottom();
}

function addBotMessage(message) {
    messages.value.push({ sender: "bot", text: message });
    scrollToBottom();
}

function respondToUser(userMessage) {
    setTimeout(() => {
        addBotMessage("This is a response from the chatbot.");
    }, 500);
}

function sendMessage() {
    if (userInput.value.trim() === "") return;
    addUserMessage(userInput.value);
    respondToUser(userInput.value);
    userInput.value = "";
}

function scrollToBottom() {
    nextTick(() => {
        if (chatbox.value) {
            chatbox.value.scrollTop = chatbox.value.scrollHeight;
        }
    });
}
</script>
