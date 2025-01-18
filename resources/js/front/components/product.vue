<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

// Reactive states
const token = useLocalStorage("token", "");
const products = ref([]);
const isCollapsed = ref(false); // State to control the collapse/expand of the additional content

const fetchService = async () => {
  try {
    axios.defaults.headers.common["Authorization"] = token.value;
    const response = await axios.get("/api/contents/type/products");
    products.value = response.data.data.map((item) => ({
      id: item.id,
      title: item.title,
      description: item.description,
      image: item.image,
    }));
  } catch (err) {
    console.log(err);
  }
};

const toggleCollapse = () => {
  isCollapsed.value = !isCollapsed.value; // Toggle collapse/expand
};

onMounted(() => {
  fetchService();
});
</script>

<template>
  <section id="products-list">
    <div class="our-products bg-white py-12">
      <div class="section-container max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
          <!-- Image Section -->
          <div class="our-product-img-section">
            <img
              src="https://addissoftware.com/wp-content/uploads/2024/05/c09dc7fdfb668e7cf2223d3cc4306864-scaled.jpeg"
              alt="Our Products"
              class="w-full h-auto rounded-lg shadow-lg"
            />
          </div>
          <!-- Content Section -->
          <div class="our-product-content">
            <h2 class="text-4xl font-bold mb-8">
              <span class="text-blue-500">02</span> Our Products
            </h2>

            <!-- Product List -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <ul class="space-y-6">
                  <li
                    v-for="(product, index) in products.slice(
                      0,
                      Math.ceil(products.length / 2)
                    )"
                    :key="index"
                    class="flex items-start gap-4"
                  >
                    <!-- Image Icon -->
                    <img
                      src="/images/icon.png"
                      alt="Product Icon"
                      class="w-14 h-16 mt-2 text-blue-500"
                    />
                    <!-- Content -->
                    <div>
                      <h3 class="text-xl font-semibold">
                        <a
                          :href="'/product/' + product.id"
                          class="text-blue-600 hover:underline"
                          target="_blank"
                          rel="noopener noreferrer"
                        >
                          {{ product.title }}
                        </a>
                      </h3>
                      <p class="text-gray-600">{{ product.description }}</p>
                    </div>
                  </li>
                </ul>
              </div>
              <div>
                <ul class="space-y-6">
                  <li
                    v-for="(product, index) in products.slice(
                      Math.ceil(products.length / 2)
                    )"
                    :key="index"
                    class="flex items-start gap-4"
                  >
                    <!-- Image Icon -->
                    <img
                      src="/images/solutions.png"
                      alt="Product Icon"
                      class="w-10 h-13 mt-4 text-blue-500"
                    />
                    <!-- Content -->
                    <div>
                      <h3 class="text-xl font-semibold">
                        <a
                          :href="'/product/' + product.id"
                          class="text-blue-600 hover:underline"
                          target="_blank"
                          rel="noopener noreferrer"
                        >
                          {{ product.title }}
                        </a>
                      </h3>
                      <p class="text-gray-600">{{ product.description }}</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Collapsible Section -->
            <div v-if="isCollapsed" class="mt-6 text-gray-700">
              <p class="mb-2">
                These are our premium products that we offer. We ensure the highest
                quality and exceptional service with each item.we offer Enterprise
                Software Systems designed to meet the unique needs of large organizations.
                Our solutions, including ERP, CRM, and HR management systems, are tailored
                to streamline operations, enhance efficiency, and foster better
                decision-making across all departments. These complex systems are built to
                scale and adapt to your organization’s growth, providing a solid
                foundation for your business. In addition to enterprise solutions, we also
                specialize in creating Mobile and Web Applications that prioritize user
                experience. Our apps are designed to drive customer engagement, improve
                accessibility, and simplify business operations. Whether it’s a mobile app
                to connect with customers or a web application to manage internal
                processes, our products are built to make your business run smoother and
                more effectively.
              </p>
            </div>

            <!-- Collapsible Button -->
            <div class="mt-6">
              <button
                @click="toggleCollapse"
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded"
              >
                {{ isCollapsed ? "Hide Product Details" : "Show More Details" }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
