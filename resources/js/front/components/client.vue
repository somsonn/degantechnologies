<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

const token = useLocalStorage("token", "");
const clients = ref([]);
const currentIndex = ref(0);
let autoSlideInterval = null;

const fetchClients = async () => {
  try {
    axios.defaults.headers.common["Authorization"] = token.value;
    const response = await axios.get("/api/clients");
    clients.value = response.data.clients;
  } catch (error) {
    console.error("Error fetching client data:", error);
  }
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % clients.value.length;
};

const prevSlide = () => {
  currentIndex.value =
    (currentIndex.value - 1 + clients.value.length) % clients.value.length;
};

const setSlide = (index) => {
  currentIndex.value = index;
};

const startAutoSlide = () => {
  autoSlideInterval = setInterval(nextSlide, 4000); // 4-second interval
};

const stopAutoSlide = () => {
  clearInterval(autoSlideInterval);
};

onMounted(async () => {
  await fetchClients();
  startAutoSlide();
});

onUnmounted(() => {
  stopAutoSlide();
});
</script>

<template>
  <div class="relative w-full max-w-5xl mx-auto mt-8">
    <div class="overflow-hidden rounded-xl shadow-md">
      <!-- Slides -->
      <div
        class="flex transition-transform duration-700 ease-in-out"
        :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
      >
        <div
          v-for="client in clients"
          :key="client.id"
          class="flex-none w-full bg-gradient-to-r from-gray-100 to-gray-50 flex items-center justify-center p-8"
        >
          <div
            class="flex flex-col items-center justify-center w-48 h-16 bg-gray-100 border border-gray-300 rounded-lg shadow-md space-y-2 p-4"
          >
            <img
              :src="client.logo"
              alt="Client Logo"
              class="w-20 h-20 object-contain rounded-md border border-gray-200"
            />
            <h2 class="text-sm font-medium text-gray-800 text-center">
              {{ client.name }}
            </h2>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <button
      class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-500 focus:outline-none focus:ring"
      @click="prevSlide"
    >
      &larr;
    </button>
    <button
      class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-blue-600 text-white p-2 rounded-full hover:bg-blue-500 focus:outline-none focus:ring"
      @click="nextSlide"
    >
      &rarr;
    </button>

    <!-- Slide Indicators -->
    <div class="flex justify-center mt-4 space-x-2">
      <button
        v-for="(client, index) in clients"
        :key="index"
        class="w-3 h-3 rounded-full"
        :class="{
          'bg-blue-600': currentIndex === index,
          'bg-gray-300': currentIndex !== index,
        }"
        @click="setSlide(index)"
      ></button>
    </div>
  </div>
</template>
