<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();

const blog = ref(null);
const error = ref(null);
const isLoading = ref(false);

// Fetch blog data by ID
const fetchBlogDetail = async (id) => {
  if (!id) {
    error.value = "Invalid blog ID.";
    return;
  }

  isLoading.value = true;
  try {
    const response = await axios.get(`/api/blogs/${id}`);
    blog.value = response.data.blog;
    error.value = null; // Clear any previous errors
  } catch (err) {
    console.error("Error fetching blog detail:", err);
    error.value = "Failed to load blog details. Please try again later.";
  } finally {
    isLoading.value = false;
  }
};

// Fetch blog details on component mount
onMounted(() => {
  const id = route.params.id;
  if (!id) {
    error.value = "No blog ID found in the URL.";
    return;
  }
  fetchBlogDetail(id);
});
</script>

<template>
  <section id="blog-detail" class="py-12 bg-gray-100">
    <div class="max-w-4xl mx-auto px-4">
      <!-- Loading State -->
      <div v-if="isLoading" class="text-blue-500 text-center mt-4">Loading...</div>

      <!-- Error State -->
      <div v-if="error" class="text-red-500 text-center mt-4">{{ error }}</div>

      <!-- Blog Content -->
      <div v-if="blog && !isLoading && !error" class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Blog Image -->
        <div class="h-80 overflow-hidden">
          <img
            :src="`/images/${blog.image}`"
            alt="Blog Image"
            class="w-full h-full object-cover"
          />
        </div>

        <!-- Blog Title and Content -->
        <div class="px-6 py-8">
          <h2 class="text-3xl font-extrabold text-blue-600">{{ blog.title }}</h2>
          <p class="text-gray-700 mt-4">{{ blog.content }}</p>
        </div>

        <!-- Back Button -->
        <div class="px-6 py-4">
          <router-link
            to="/"
            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:ring-2 focus:ring-blue-400"
          >
            Back to Blogs
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
#blog-detail {
  background-color: #f9fafb;
}
</style>
