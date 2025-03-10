<template>
  <section id="about" class="bg-gray-50 pt-10">
    <!-- Company History Section -->
    <div class="container mx-auto mt-24 mb-16">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Text Content -->
        <div class="mt-10">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Our Company History</h2>
          <p class="text-gray-600 leading-relaxed mb-6">
            Established in 2010, our company has consistently delivered innovative
            solutions to meet the evolving needs of our clients. From humble beginnings to
            industry leader, we are proud of our journey and our impact.
          </p>
          <transition name="fade">
            <div v-if="showMore">
              <p class="text-gray-600 leading-relaxed mb-6">
                Over the past decade, Degan Technologies has expanded globally,
                integrating cutting-edge technologies and fostering a culture of
                excellence. With a dedicated team, we aim to redefine innovation and
                provide unparalleled value to our clients.
              </p>
            </div>
          </transition>
          <button
            @click="toggleMore"
            class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transition-all duration-300"
          >
            {{ showMore ? "See Less" : "See More" }}
          </button>
        </div>
        <!-- Image -->
        <div>
          <img
            src="http://127.0.0.1:8000/images/dega.png"
            alt="Degan Technologies"
            class="rounded-lg shadow-lg w-full object-cover transform hover:scale-105 transition-transform duration-300"
          />
        </div>
      </div>
    </div>

    <!-- Mission, Vision, and Values Section -->
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Image -->
        <div>
          <img
            src="http://127.0.0.1:8000/images/degann.png"
            alt="Degan Technologies"
            class="rounded-lg mt-14 shadow-lg w-full object-cover transform hover:scale-105 transition-transform duration-300"
          />
        </div>
        <!-- Text Content -->
        <div class="space-y-8">
          <!-- Mission -->
          <div class="flex items-start space-x-4 group">
            <div
              class="flex-shrink-0 text-blue-500 transition-transform transform group-hover:scale-125 duration-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 12h3m0 0h3m-3-3v6m0 6a9 9 0 100-18 9 9 0 000 18z"
                />
              </svg>
            </div>
            <div>
              <h3 class="text-3xl font-bold text-blue-600 mb-2">Our Mission</h3>
              <p class="text-gray-600 leading-relaxed">{{ mission }}</p>
            </div>
          </div>
          <!-- Vision -->
          <div class="flex items-start space-x-4 group">
            <div
              class="flex-shrink-0 text-green-500 transition-transform transform group-hover:scale-125 duration-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 16h-1v-4h-1m1 0h2m-3 0V8m8 8V4m0 8l-2 2m-6-6L5 12"
                />
              </svg>
            </div>
            <div>
              <h3 class="text-3xl font-bold text-green-600 mb-2">Our Vision</h3>
              <p class="text-gray-600 leading-relaxed">{{ vision }}</p>
            </div>
          </div>
          <!-- Values -->
          <!-- Values -->
          <div class="flex items-start space-x-4 group">
            <div
              class="flex-shrink-0 text-yellow-500 transition-transform transform group-hover:scale-125 duration-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-12 w-12"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 20l9-7-9-7-9 7 9 7z"
                />
              </svg>
            </div>
            <div>
              <h3 class="text-3xl font-bold text-yellow-600 mb-4">Our Values</h3>
              <div class="space-y-6">
                <div v-for="value in values" :key="value.id" class="mb-4">
                  <h4 class="text-xl font-semibold text-gray-800">{{ value.title }}</h4>
                  <p class="text-gray-600 leading-relaxed">{{ value.description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

// Use token from local storage
const token = useLocalStorage("token", "");
axios.defaults.headers.common["Authorization"] = token.value;

// Reactive variables
const mission = ref("");
const vision = ref("");
const values = ref([]);

// Fetch content from API
const fetchContent = async () => {
  try {
    axios.defaults.headers.common["Authorization"] = token.value;

    // Fetch mission
    const missionResponse = await axios.get("/api/contents/type/mission");
    mission.value = missionResponse.data.data[0]?.description || ""; // Assuming description is the correct field

    // Fetch vision
    const visionResponse = await axios.get("/api/contents/type/vision");
    vision.value = visionResponse.data.data[0]?.description || ""; // Handle array or empty data

    // Fetch values
    const valuesResponse = await axios.get("/api/contents/type/value");
    values.value = valuesResponse.data.data.map((value) => ({
      title: value.title,
      description: value.description,
      id: value.id, // Include ID for unique key
    }));
  } catch (error) {
    console.error("Error fetching content:", error);
  }
};

// Call fetchContent on component mount
onMounted(fetchContent);

// Show more toggle
const showMore = ref(false);
const toggleMore = () => {
  showMore.value = !showMore.value;
};
</script>

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
