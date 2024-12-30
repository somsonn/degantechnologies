<script setup>
import name from "../../components/name.vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { ref, onMounted } from "vue";
import { useAlertsStore } from "../../../store/useAlertsStore";
import { useRoute } from "vue-router";

const alertstore = useAlertsStore();
const route = useRoute();
const portfolioId = ref(route.params.id);
const portfolio = ref({ project_name: "", description: "" });
const imageUpload = ref(null);
const token = useLocalStorage("token", "");
const formData = new FormData();

onMounted(() => {
  axios.get(`./api/portfolios/${portfolioId.value}`)
    .then((res) => {
      portfolio.value = res.data;
    })
    .catch((err) => {
      alertstore.showErrortost(err.response?.data?.error || "An error occurred");
    });
});

const updatePortfolio = () => {
  const selectedImage = imageUpload.value?.files?.[0];
  if (selectedImage) {
    formData.append("image", selectedImage);
  }
  formData.append("title", portfolio.value.project_name);
  formData.append("description", portfolio.value.description);

  axios.defaults.headers.common["Authorization"] = token.value;
  axios
    .post(`./api/portfolios/${portfolioId.value}`, formData)
    .then((res) => {
      alertstore.showSuccessToast(res.data.message);
    })
    .catch((err) => {
      alertstore.showErrortost(err.response?.data?.error || "An error occurred");
    });
};
</script>

<template>
  <name name="Edit Portfolio" />
  <div class="bg-gray-100 p-16">
    <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
      <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">Edit Portfolio</h1>
          <form class="mb-6">
            <div class="mb-6">
              <label for="projectname" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Project Name
              </label>
              <input
                type="text"
                id="projectname"
                v-model="portfolio.title"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                placeholder="Enter project name"
              />
            </div>

            <div class="mb-6">
              <label for="description" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Description
              </label>
              <textarea
                id="description"
                v-model="portfolio.description"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                placeholder="Enter project description"
              ></textarea>
            </div>

            <div class="mb-6">
              <label for="file" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Upload Portfolio
              </label>
              <input
                type="file"
                id="file"
                ref="imageUpload"
                accept=".png,.jpg,.jpeg,.gif"
                @change="() => {}"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
              />
            </div>

            <button
              @click.prevent="updatePortfolio"
              class="text-white bg-blue-700 capitalize hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block"
            >
              Update Portfolio
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
