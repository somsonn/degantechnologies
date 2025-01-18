<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const portfolio = ref(null);
const error = ref(null);
const isLoading = ref(false);

// Fetch portfolio data by ID
const fetchportfolioDetail = async (id) => {
  if (!id) {
    error.value = "Invalid portfolio ID.";
    return;
  }

  isLoading.value = true;
  try {
    const response = await axios.get(`/api/portfolios/${id}`);
    portfolio.value = response.data.data;
    error.value = null;
  } catch (err) {
    console.error("Error fetching portfolio detail:", err);
    error.value = "Failed to load portfolio details. Please try again later.";
  } finally {
    isLoading.value = false;
  }
};

// Fetch portfolio details on component mount
onMounted(() => {
  const id = route.params.id;
  if (!id) {
    error.value = "No portfolio ID found in the URL.";
    return;
  }
  fetchportfolioDetail(id);
});
</script>

<template>
  <section class="py-8 mt-10 pt-10 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4">
      <div v-if="isLoading" class="text-blue-500 text-center mt-4">Loading...</div>
      <div v-if="error" class="text-red-500 text-center mt-4">{{ error }}</div>
      <div v-if="portfolio && !isLoading && !error" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Image Container -->
        <div class="overflow-hidden bg-gray-200">
          <img
            :src="`/images/${portfolio.file}`"
            alt="portfolio Image"
            class="w-full h-auto object-contain"
          />
        </div>
        <div class="px-6 py-8">
          <h2 class="text-3xl font-extrabold text-blue-600">{{ portfolio.title }}</h2>
          <p class="text-gray-700 mt-4">{{ portfolio.description }}</p>
        </div>
        <div class="px-6 py-4">
          <router-link
            to="/portfront"
            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-400"
          >
            Back to portfolio
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
#portfolio-detail {
  background-color: #f9fafb;
}
</style>
