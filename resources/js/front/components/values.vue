<template>
  <section
    id="slider"
    class="relative h-[600px] md:h-[700px] lg:h-[800px] overflow-hidden"
  >
    <!-- Slider Images -->
    <div class="relative w-full h-full">
      <div
        v-for="(data, index) in sliderData"
        :key="index"
        class="absolute top-0 left-0 w-full h-full transition-all duration-500 ease-in-out"
        :style="{
          transform: `translateX(${(index - currentIndex) * 100}%)`,
        }"
      >
        <img :src="data.image" alt="Slider Image" class="w-full h-full object-cover" />
        <!-- Centered Text Overlay -->
        <div
          class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-opacity-80 bg-gray-900 text-white p-10 rounded-lg w-[90%] sm:w-[75%] lg:w-[60%]"
        >
          <h2 class="text-3xl font-bold mb-4 text-center">{{ data.title }}</h2>
          <p class="text-lg leading-relaxed text-center">{{ data.description }}</p>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <button
      @click="prevImage"
      class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white p-3 rounded-full hover:bg-opacity-90 shadow-lg"
    >
      &#x276E;
    </button>
    <button
      @click="nextImage"
      class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 bg-opacity-70 text-white p-3 rounded-full hover:bg-opacity-90 shadow-lg"
    >
      &#x276F;
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
      <span
        v-for="(data, index) in sliderData"
        :key="index"
        class="w-4 h-4 rounded-full cursor-pointer"
        :class="currentIndex === index ? 'bg-blue-500' : 'bg-gray-400'"
        @click="currentIndex = index"
      ></span>
    </div>
  </section>

  <!-- Cards Section -->
  <section id="cards" class="bg-gray-50 py-12 px-4">
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold mb-2">Our Values</h1>
      <p class="text-gray-600">
        Committed to delivering the highest quality in every product and service.
      </p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <div
        v-for="(content, index) in contents"
        :key="index"
        class="flex flex-col items-center p-6 gap-4 rounded-2xl shadow-lg bg-blue-900 text-white hover:scale-105 transition-transform"
      >
        <img :src="getImage(index)" alt="Card Icon" class="w-16 h-16" />
        <h3 class="text-xl font-bold text-center">{{ content.title }}</h3>
        <p class="text-sm text-center">{{ content.description }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

// Slider functionality
const sliderData = [
  {
    image: "/images/degan2.jpg",
    title: "Welcome to Degan",
    description: `At Degan, we aim to provide excellence in every step of our journey.
                      We believe in creating value and delivering top-quality solutions.`,
  },
  {
    image: "/images/image.png",
    title: "Tailored Enterprise Solutions for Your Business",
    description:
      "Transform your business with our custom-built enterprise software systems, including ERP, CRM, and HR management solutions, designed to streamline operations and scale with your company's growth..",
  },
  {
    image: "/images/degan1.png",
    title: "Your Partner in Digital Transformation",
    description:
      "From strategy to execution, we help businesses embrace technology to achieve their full potential.",
  },
  {
    image: "/images/degan3.JPG",
    title: "Engage Customers with Seamless Mobile & Web Apps",
    description:
      "Elevate your business with user-friendly mobile and web applications that enhance customer engagement, simplify processes, and drive business success.",
  },
];

const currentIndex = ref(0);
const sliderInterval = ref(null);

const nextImage = () => {
  currentIndex.value = (currentIndex.value + 1) % sliderData.length;
};

const prevImage = () => {
  currentIndex.value = (currentIndex.value - 1 + sliderData.length) % sliderData.length;
};

const startSlider = () => {
  sliderInterval.value = setInterval(() => {
    nextImage();
  }, 4000);
};

const stopSlider = () => {
  clearInterval(sliderInterval.value);
};

// Fetch contents for cards
const token = useLocalStorage("token", "");
const contents = ref([]);

const fetchContents = async () => {
  try {
    axios.defaults.headers.common["Authorization"] = token.value;
    const response = await axios.get("/api/contents/type/value");
    contents.value = response.data.data;
  } catch (err) {
    console.log(err);
  }
};

// Get the card image based on the index
const getImage = (index) => {
  const cardImages = ["/images/degaa.png", "/images/degannn.png", "/images/degaaaaa.png"];
  return cardImages[index % cardImages.length];
};

onMounted(() => {
  startSlider();
  fetchContents();
});

onUnmounted(() => {
  stopSlider();
});
</script>

<style scoped>
button {
  font-size: 1.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

button:hover {
  transform: scale(1.1);
}
</style>
