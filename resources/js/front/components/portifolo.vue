<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useRouter } from "vue-router";

const token = useLocalStorage("token", "");
const portfolios = ref([]);
const router = useRouter();
const zoomedImage = ref(null);

// Fetch portfolios
const fetchportfolios = async () => {
  axios.defaults.headers.common["Authorization"] = token.value;
  try {
    const response = await axios.get("/api/portfolios");
    portfolios.value = response.data.data;
  } catch (error) {
    console.error("Error fetching portfolios:", error);
  }
};

// Navigate to portfolio detail page
const portfolioDetail = (id) => {
  router.push({ name: "portfolioDetail", params: { id } });
};

// Zoom functionality
const zoomImage = (image) => {
  zoomedImage.value = image;
};

// Unzoom functionality when clicking outside the zoomed image
const unzoomImage = () => {
  zoomedImage.value = null;
};

onMounted(() => {
  fetchportfolios();
});
</script>

<template>
  <section class="py-12 mt-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
      <!-- Title with enhanced styling -->
      <h2 class="text-5xl font-extrabold text-center mb-12 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">
        Our portfolios ...
      </h2>

      <!-- portfolio Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <div
          v-for="(portfolio, index) in portfolios"
          :key="index"
          class="relative flex flex-col bg-white rounded-xl shadow-md transition-all duration-300 hover:shadow-xl transform hover:scale-105"
        >
          <!-- Image with hover options -->
          <div class="relative overflow-hidden rounded-t-xl group">
            <img
              :src="`/images/${portfolio.file}`"
              alt="portfolio Image"
              class="w-full h-56 object-cover group-hover:opacity-75 transition-opacity duration-300 ease-in-out border-4 border-white"
            />

            <!-- Hover Options (Zoom and View) -->
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
              <button
                @click="zoomImage(portfolio.file)"
                class="bg-blue-600 text-white py-2 px-4 rounded-full mr-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transform hover:scale-110 transition-all duration-300 border-2 border-white"
              >
                Zoom
              </button>
              <button
                @click="portfolioDetail(portfolio.id)"
                class="bg-green-600 text-white py-2 px-4 rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 transform hover:scale-110 transition-all duration-300 border-2 border-white"
              >
                View
              </button>
            </div>
          </div>

          <!-- portfolio Title -->
          <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 transition-all duration-300 hover:text-blue-600">
              {{ portfolio.title }}
            </h3>
          </div>

          <!-- Zoomed Image View -->
          <div
            v-if="zoomedImage === portfolio.file"
            class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center z-10 cursor-pointer"
            @click="unzoomImage"
          >
            <img :src="`/images/${portfolio.file}`" alt="Zoomed Image" class="max-w-full max-h-screen object-contain scale-150 transition-all duration-300 ease-in-out border-4 border-white" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Styling for the title */
.text-gradient {
  background-image: linear-gradient(90deg, rgba(37,99,235,1) 0%, rgba(129,140,248,1) 100%);
}

/* Hover effects for image and title */
.group:hover .group-hover\:opacity-75 {
  opacity: 0.75;
}

.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}

.scale-150 {
  transform: scale(2.5); /* Dramatically increase the zoom factor */
}

/* Add subtle hover effect on title */
h2:hover {
  transform: scale(1.05);
  transition: transform 0.3s ease-in-out;
}

/* Add subtle hover effect on portfolio title */
h3:hover {
  color: #1d4ed8; /* Tailwind Blue */
  transform: scale(1.1);
  transition: color 0.3s ease, transform 0.3s ease;
}

/* Animation for buttons */
button:hover {
  transform: scale(1.1);
  transition: transform 0.3s ease-in-out;
}

/* Circular buttons */
button {
  border-radius: 9999px; /* Make buttons circular */
}

/* Button hover color change */
button:hover {
  background-color: #2b353d; /* Blue */
  color: white;
}

/* Smooth zoom effect */
img {
  transition: transform 0.3s ease-in-out;
}

img:hover {
  transform: scale(1.1);
}

/* Styling for zoomed image */
.zoomed-view img {
  transform: scale(1.5); /* Increased zoom size */
}

/* Custom background color for zoomed view */
.zoomed-view {
  background-color: rgba(0, 0, 0, 0.8); /* Dark background */
}

/* Adding white borders */
img,
button {
  border: 2px solid white; /* Adding white border to the image and buttons */
}
</style>
