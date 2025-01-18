<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

const token = useLocalStorage("token", "");
axios.defaults.headers.common["Authorization"] = token.value;

const historyDescription = ref("");
const historyImage = ref("");

const fetchCompanyHistory = async () => {
  try {
    const response = await axios.get("/api/company-histories");
    const historyData = response.data.companyHistories[0]; // Adjust this based on your actual API response structure

    if (historyData) {
      historyDescription.value = historyData.description || "No description available.";
      historyImage.value = `/images/${historyData.image}`; // Adjust if your image path differs
    }
  } catch (error) {
    console.error("Error fetching company history:", error);
  }
};

onMounted(fetchCompanyHistory);
</script>

<template>
  <section id="about" class="bg-gray-50 pt-10">
    <!-- Company History Section -->
    <div class="container mx-auto mt-24 mb-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Text Content -->
        <div class="mt-10">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Company History</h2>
          <p class="text-gray-600 leading-relaxed mb-6">
            {{ historyDescription }}
          </p>
        </div>
        <!-- Image -->
        <div v-if="historyImage">
          <img
            :src="historyImage"
            alt="Company History Image"
            class="rounded-lg shadow-lg w-full object-cover transform hover:scale-105 transition-transform duration-300"
          />
        </div>
      </div>
    </div>
  </section>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
