<script setup>
import name from "../../../components/name.vue";
import axios from "axios";
import { onMounted, ref } from "vue";

const contentss = ref([]);

onMounted(async () => {
  axios.defaults.headers.common["Authorization"] = token.value;
  try {
    const res = await axios.get("./api/contents");
    console.log(res.data);
    contentss.value = res.data.data;
  } catch (err) {
    console.error(err);
  }
});
</script>

<template>
  <div class="bg-gray-100">
    <name name=" Contents" />
    <div class="m-4 rounded">
      <div
        class="w-full bg-white border-b-2 rounded border-gray-200 flex flex-row justify-between"
      >
        <h1 class="font-bold text-gray-500 text-lg p-4 capitalize">content table</h1>
        <router-link
          to="/contentpost"
          class="w-fit text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 m-4 text-center"
          >Add product</router-link
        >
      </div>
      <div class="flex bg-white flex-col items-center justify-center">
        <div class="w-full relative p-2 overflow-x-auto shadow-md sm:rounded-lg xs:p-5">
          <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3">number</th>
                <th scope="col" class="px-6 py-3">title</th>
                <th scope="col" class="px-6 py-3">description</th>
                <th scope="col" class="px-6 py-3">type</th>
                <th scope="col" class="px-6 py-3">edit</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(content, index) in contentss"
                :key="content.id"
                class="bg-white border-b hover:bg-gray-50"
              >
                <td class="px-6 py-4">{{ index + 1 }}</td>
                <td class="px-6 py-4">{{ content.title }}</td>
                <td class="px-6 py-4">{{ content.description }}</td>
                <td class="px-6 py-4">{{ content.type }}</td>
                <td class="px-6 py-4">
                  <router-link
                    :to="{ name: 'contentedit', params: { id: content.id } }"
                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                    >edit</router-link
                  >
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
