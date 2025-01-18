<script setup>
import axios from "axios";
import { onMounted, ref, computed } from "vue";
import succs from "../conformation/succ.vue";
import errs from "../conformation/err.vue";
import name from "../../components/name.vue";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const token = useLocalStorage("token", "");
const clients = ref([]);
const removedClientIds = ref([]);
const countClients = ref(0);
const succ = ref("");
const err = ref("");
const perPage = ref(5);
const currentPage = ref(1);
const keywords = ref("");

function getAllClients() {
  axios.defaults.headers.common["Authorization"] = token.value;
  axios
    .get("./api/clients")
    .then((res) => {
      clients.value = res.data;
    })
    .catch((err) => console.log(err));
}

onMounted(async () => {
  await getAllClients();
});

function countTrashClients(id) {
  if (removedClientIds.value.includes(id)) {
    removedClientIds.value = removedClientIds.value.filter((singleId) => singleId !== id);
    countClients.value = removedClientIds.value.length;
  } else {
    removedClientIds.value.push(id);
    countClients.value = removedClientIds.value.length;
  }
}

const hideClient = () => {
  axios.defaults.headers.common["Authorization"] = token.value;
  axios
    .post("./api/clients/hidden", { id: removedClientIds.value })
    .then((res) => {
      alertstore.showSuccessToast(res.data.message);
      getAllClients();
      setTimeout(() => {
        removedClientIds.value = [];
        countClients.value = 0;
      }, 2000);
    })
    .catch((error) => {
      alertstore.showErrortost(error.message.data.error);
    });
};

const deleteClient = async (id) => {
  axios.defaults.headers.common["Authorization"] = token.value;
  await axios
    .delete(`./api/clients/${id}`)
    .then((res) => {
      alertstore.showSuccessToast(res.data.message);
      clients.value = clients.value.filter((client) => client.id !== id);
    })
    .catch((error) => {
      alertstore.showErrortost(error.response.data.error);
    });
};

const searching = computed(() => {
  const keyword = keywords.value.toLowerCase();
  return clients.value.filter((client) => client.name.toLowerCase().includes(keyword));
});

const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * perPage.value;
  const end = start + perPage.value;
  return searching.value.slice(start, end);
});

const totalPages = computed(() => Math.ceil(searching.value.length / perPage.value));
const prevPage = () => {
  if (currentPage.value > 1) {
    currentPage.value--;
  }
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) {
    currentPage.value++;
  }
};
</script>

<template>
  <div class="bg-gray-100">
    <name name="Clients" />
    <succs v-if="succ" :succ="succ" />
    <errs v-if="err" :err="err" />
    <div class="m-4 mt-12 rounded">
      <div
        class="w-full bg-white border-b-2 rounded border-gray-200 flex flex-row justify-between"
      >
        <h1 class="font-bold text-gray-500 text-lg p-4">Clients List</h1>
        <router-link
          to="/clientpost"
          class="w-fit text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 m-4 text-center"
        >
          Add Client
        </router-link>
      </div>
      <!-- Table starts here -->
      <div class="flex bg-white flex-col items-center justify-center">
        <div class="w-full relative p-2 overflow-x-auto shadow-md sm:rounded-lg xs:p-5">
          <div
            class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4"
          >
            <div v-if="countClients" class="align-middle">
              <p>
                <span
                  class="text-blue-500 w-4 h-4 bg-gray-200 rounded-full p-2 font-bold"
                >
                  {{ countClients }}
                </span>
                row(s) selected
                <i
                  @click.prevent="hideClient"
                  class="material-icons text-xl font-extrabold w-10 h-10 hover:bg-gray-400 text-center p-2 bg-gray-200 rounded-full text-red-500"
                >
                  delete
                </i>
              </p>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
              <div
                class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none"
              >
                <i class="fa-solid fa-magnifying-glass"></i>
              </div>
              <input
                v-model="keywords"
                type="text"
                id="table-search"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-sky-500 focus:border-sky-500 outline-none"
                placeholder="Search for clients"
              />
            </div>
          </div>
          <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">Mark</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Logo</th>
                <th scope="col" class="px-6 py-3">Website</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody v-for="client in paginatedData" :key="client.id">
              <tr class="bg-white border-b hover:bg-gray-50">
                <td @click.prevent="countTrashClients(client.id)" class="w-4 p-4">
                  <div class="border-4 border-gray-200 text-center rounded w-5 h-5">
                    <p v-if="removedClientIds.includes(client.id)">
                      <i class="material-icons text-2xl font-bold text-green-600">done</i>
                    </p>
                  </div>
                </td>
                <td class="px-6 py-4">{{ client.name }}</td>
                <td class="px-6 py-4">
                  <img
                    v-if="client.logo"
                    :src="client.logo"
                    class="w-16 h-10 object-cover"
                    alt="client-logo"
                  />
                </td>
                <td class="px-6 py-4">
                  <a
                    v-if="client.website"
                    :href="client.website"
                    target="_blank"
                    class="text-sky-600 hover:underline"
                    >{{ client.website }}</a
                  >
                </td>
                <td>
                  <router-link
                    :to="{ name: 'clientedit', params: { id: client.id } }"
                    class="text-lg text-blue-700 hover:text-sky-800"
                  >
                    Edit
                  </router-link>
                  <button
                    type="button"
                    class="text-lg text-red-700 hover:text-sky-800"
                    @click="deleteClient(client.id)"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-if="perPage >= 5" class="w-full justify-center gap-2 flex flex-row pt-4">
            <div>
              <button
                class="shadow p-2 bg-gray-200 active:text-red-500 hover:bg-gray-300 text-briteblue text-lg font-bold rounded"
                @click="prevPage"
                :disabled="currentPage === 1"
              >
                Back
              </button>
            </div>
            <div>
              <button
                class="shadow p-2 bg-gray-200 text-briteblue hover:bg-gray-300 text-lg font-bold rounded"
              >
                Page {{ currentPage }}
              </button>
            </div>
            <div>
              <button
                class="shadow p-2 bg-gray-200 active:text-red-500 text-briteblue hover:bg-gray-300 text-lg font-bold rounded"
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
  </div>
</template>
