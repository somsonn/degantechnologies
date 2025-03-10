<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
const portfolios = ref([]);
onMounted(async () => {
  try {
    const response = await axios.get("/api/portfolios");
    portfolios.value = response.data.data.map((item) => ({
      ...item,
      showFullDescription: false,
    }));
  } catch (error) {
    console.error("Error fetching portfolio data:", error);
  }
});
const toggleDescription = (portfolio) => {
  portfolio.showFullDescription = !portfolio.showFullDescription;
};
</script>
<template>
  <section id="portfolio" class="py-20 bg-white">
    <div class="container mx-auto px-6 lg:px-20">
      <!-- Heading Section -->
      <div class="text-center mb-12">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Our Portfolio</h2>
        <p class="text-lg text-gray-600">
          Explore some of the exceptional projects we've delivered to our clients.
        </p>
      </div>

      <!-- Project Grid -->
      <div
        v-if="portfolios.length"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"
      >
        <div
          v-for="portfolio in portfolios"
          :key="portfolio.id"
          class="rounded-xl shadow-lg bg-white hover:shadow-xl transition-shadow duration-300"
        >
          <img
            :src="`/${portfolio.file}`"
            :alt="portfolio.title"
            class="rounded-t-xl w-full"
          />
          <div class="p-4 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">
              {{ portfolio.title }}
            </h3>

            <!-- Conditionally Display Full Description -->
            <p v-if="portfolio.showFullDescription" class="text-gray-600 text-sm mb-4">
              {{ portfolio.description }}
            </p>

            <!-- Read More Button -->
            <button
              @click="toggleDescription(portfolio)"
              class="text-blue-500 font-medium hover:underline"
            >
              {{ portfolio.showFullDescription ? "Show Less" : "Read More" }}
            </button>
          </div>
        </div>
      </div>
      <!-- No Data Fallback -->
      <div v-else class="text-center text-gray-600">
        <p>No portfolio items to display at the moment.</p>
      </div>
    </div>
  </section>
</template>
