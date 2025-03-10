<template>
  <button
    v-if="isScrollTopVisible"
    @click="scrollToTop"
    class="fixed bottom-8 right-8 bg-blue-600 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg hover:bg-blue-700 transition"
  >
    <span class="text-4xl font-bold leading-none">↑</span>
  </button>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

const isScrollTopVisible = ref(false);

const handleScroll = () => {
  // Show button after scrolling 300px
  isScrollTopVisible.value = window.scrollY > 300;
};

const scrollToTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
/* Optional: Add custom styles if needed */
</style>
