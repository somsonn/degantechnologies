<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../../store/useAlertsStore";
import { useRoute } from "vue-router";

const alertstore = useAlertsStore();
const route = useRoute();
const title = ref("");
const logo = ref(null);
const description = ref("");
const type=ref(route.params.type);
const token = useLocalStorage("token", "");
const formData = new FormData();
const data = ref([]);

const fetchContent = () => {
    axios.defaults.headers.common["Authorization"] = token.value;
    axios
        .get(`./api/contents/${type.value}`)
        .then((res) => {
            data.value = res.data.data;
            title.value = data.value[0].title
            description.value = data.value[0].description;
            type.value=data.value[0].type;
        })
        .catch((err) => {
            alertstore.showErrortost(err.response?.data?.error );
        });
};

const selectLogo = () => {
    const selectedLogo = logo.value.files[0];
    if (selectedLogo) {
        formData.append("image", selectedLogo);
    }
};

const updatecontent= () => {
    formData.append("title", title.value);
    formData.append("description", description.value);
    formData.append("type", type.value);

    axios.defaults.headers.common["Authorization"] = token.value;
    axios
        .put(`/api/contents/${id.value}`, formData)
        .then((res) => {
            alertstore.showSuccessToast(res.data.message);
        })
        .catch((err) => {
            alertstore.showErrortost(err.response?.data?.error );
        });
};

onMounted(fetchContent);
</script>

<template>
    {{ title }}
    <div class="bg-gray-100 p-16">
        <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">Edit  Information</h1>
                    <form class="mb-6 space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 capitalize"> title</label>
                            <input type="text" id="name" v-model="title"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Enter client name" required />
                        </div>
                        
                        
                        <div>
                            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 capitalize">description</label>
                            <input type="text" id="website" v-model="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Enter description" />
                        </div>
                        <div>
                            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 capitalize">type</label>
                            <input type="text" id="website" v-model="type"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Enter type" />
                        </div>
                        <div>
                            <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Update photo</label>
                            <input type="file" ref="logo" @change="selectLogo"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                        </div>
                        <button @click.prevent="updatecontent"
                            class="text-white bg-blue-700 hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg capitalize text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block">Update
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

