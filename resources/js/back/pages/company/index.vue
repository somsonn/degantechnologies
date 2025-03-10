<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const token = useLocalStorage("token", "");
const histories = ref([]);
const keywords = ref("");
const currentPage = ref(1);
const perPage = ref(5);

const fetchHistories = () => {
  axios.defaults.headers.common["Authorization"] = token.value;
  axios
    .get("/api/company_historys")
    .then((res) => (histories.value = res.data))
    .catch((err) =>
      alertstore.showErrortost(err.response?.data?.error || "An error occurred")
    );
};

const deleteHistory = (id) => {
  axios.defaults.headers.common["Authorization"] = token.value;
  axios
    .delete(`/api/company_historys/${id}`)
    .then((res) => {
      alertstore.showSuccessToast(res.data.message);
      histories.value = histories.value.filter((history) => history.id !== id);
    })
    .catch((err) =>
      alertstore.showErrortost(err.response?.data?.error || "An error occurred")
    );
};

// Search and Pagination Logic
const filteredHistories = computed(() => {
  if (keywords.value.trim()) {
    return histories.value.filter(
      (history) =>
        history.title.toLowerCase().includes(keywords.value.toLowerCase()) ||
        history.description.toLowerCase().includes(keywords.value.toLowerCase()) ||
        history.year.toString().includes(keywords.value)
    );
  }
  return histories.value;
});

const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * perPage.value;
  return filteredHistories.value.slice(start, start + perPage.value);
});

const totalPages = computed(() =>
  Math.ceil(filteredHistories.value.length / perPage.value)
);

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--;
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) currentPage.value++;
};

onMounted(fetchHistories);
</script>

<template>
  <div class="bg-gray-100">
    <name name="Company Histories" />
    <succs v-if="succ" :succ="succ" />
    <errs v-if="err" :err="err" />
    <div class="m-4 mt-12 rounded">
      <div
        class="w-full bg-white border-b-2 rounded border-gray-200 flex flex-row justify-between"
      >
        <h1 class="font-bold text-gray-500 text-lg p-4">Company History List</h1>
        <router-link
          to="/companypost"
          class="w-fit text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 m-4 text-center"
        >
          Add History
        </router-link>
      </div>
      <!-- Table -->
      <div class="flex bg-white flex-col items-center justify-center">
        <div class="w-full relative p-4 overflow-x-auto shadow-md sm:rounded-lg">
          <!-- Search -->
          <div class="flex flex-wrap items-center justify-between pb-4">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
              <input
                v-model="keywords"
                type="text"
                id="table-search"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-sky-500 focus:border-sky-500 outline-none"
                placeholder="Search for histories"
              />
            </div>
          </div>
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Year</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="history in paginatedData"
                :key="history.id"
                class="bg-white border-b hover:bg-gray-50"
              >
                <td class="px-6 py-4">{{ history.id }}</td>
                <td class="px-6 py-4">{{ history.title }}</td>
                <td class="px-6 py-4">{{ history.description }}</td>
                <td class="px-6 py-4">{{ history.year }}</td>
                <td class="px-6 py-4 flex space-x-4">
                  <router-link
                    :to="{ name: 'companyedit', params: { id: history.id } }"
                    class="text-blue-700 hover:underline"
                  >
                    Edit
                  </router-link>
                  <button
                    class="text-red-700 hover:underline"
                    @click="deleteHistory(history.id)"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- Pagination -->
          <div class="w-full flex justify-center gap-4 pt-4">
            <button
              class="shadow p-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded"
              @click="prevPage"
              :disabled="currentPage === 1"
            >
              Back
            </button>
            <span class="text-gray-700 font-medium">Page {{ currentPage }}</span>
            <button
              class="shadow p-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded"
              @click="nextPage"
              :disabled="currentPage === totalPages"
            >
              Next
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
