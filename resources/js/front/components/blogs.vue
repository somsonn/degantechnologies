<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useRouter } from "vue-router";

const token = useLocalStorage("token", "");
const blogs = ref([]);
const router = useRouter();
const fetchBlogs = async () => {
  axios.defaults.headers.common["Authorization"] = token.value;
  try {
    const response = await axios.get("/api/blogs");
    blogs.value = response.data.blogs;
  } catch (error) {
    console.error("Error fetching blogs:", error);
  }
};
const goToBlogDetail = (id) => {
  router.push({ name: "BlogDetail", params: { id } });
};

onMounted(() => {
  fetchBlogs();
});
</script>

<template>
  <section id="blogs" class="py-12 bg-gray-100">
    <div class="max-w-5xl  mx-auto px-1">
      <h2 class="text-4xl font-extrabold text-center mb-10 text-blue-600">Blogs</h2>

      <div class="grid gap-8 md:grid-cols-3">
        <div
          v-for="(blog, index) in blogs"
          :key="index"
          class="relative flex flex-col bg-white shadow-lg rounded-lg overflow-hidden hover:scale-105 hover:shadow-xl transition-all duration-300"
        >
          <div class="h-40 overflow-hidden">
            <img
              :src="`/images/${blog.image}`"
              alt="Blog Image"
              class="w-full h-full object-cover"
            />
          </div>
          <div class="px-6 mt-4">
            <h3 class="text-xl font-bold text-center text-blue-700">{{ blog.title }}</h3>
          </div>
          <div class="px-6 mt-4 flex-1">
            <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
              {{ blog.content }}
            </p>
          </div>
          <div class="p-4">
            <button
              @click="goToBlogDetail(blog.id)"
              class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 hover:-translate-y-1 transform transition duration-200 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            >
              Read More
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
