<script setup>
import name from "../../../components/name.vue";
import axios from "axios";
import { ref } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../../store/useAlertsStore";

const alertStore = useAlertsStore();

const contentType = ref(''); 
const title = ref('');
const description = ref('');
const image = ref(null); // Image file reference

const token = useLocalStorage('token', '');
const formData = new FormData();

const selectImage = () => {
    const selectedImage = image.value.files[0];
    if (selectedImage) {
        formData.append('image', selectedImage);
    }
};

const submitContent = () => {
  formData.append('type', contentType.value);
  formData.append('title', title.value);
  formData.append('description', description.value);

  axios.defaults.headers.common['Authorization'] = token.value;

  axios
    .post('./api/contents', formData)
    .then((res) => {
      alertStore.showSuccessToast(res.data.message);
      setTimeout(() => {
        Type.value = '';
        title.value = '';
        description.value = '';
        image.value = null;
      }, 2000);
    })
    .catch((err) => {
      alertStore.showErrortost(err.response.data.error || "An error occurred.");
    });
};
</script>

<template>
  <name name="Create Content" />
  <div class="bg-gray-100 p-16">
    <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
      <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">
            Create New Content
          </h1>
          <form @submit.prevent="submitContent">
            <!-- Content Type Dropdown -->
            

            <!-- Title -->
            <div class="mb-6">
              <label for="title" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Title
              </label>
              <input
                type="text"
                id="title"
                v-model="title"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter title"
                required
              />
            </div>

            <!-- Description -->
            <div class="mb-6">
              <label for="description" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Description
              </label>
              <textarea
                id="description"
                v-model="description"
                rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter description"
                required
              ></textarea>
            </div>
            <div class="mb-6">
              <label for="contentType" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Content Type
              </label>
              <select
                id="contentType"
                v-model="contentType"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="" disabled>Select  type</option>
                <option value="service">Service</option>
                <option value="products">Products</option>
              </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-6">
              <label for="image" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                Upload Image
              </label>
              <input
                type="file"
                id="image"
                @change="selectImage"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                accept="image/*"
              />
             
            </div>

            <!-- Submit Button -->
            <button
              class="text-white bg-blue-700 capitalize hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block"
            >
              Create Content
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
