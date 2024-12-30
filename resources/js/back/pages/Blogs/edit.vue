<script setup>
import name from "../../components/name.vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const route = useRoute();
const id = ref(route.params.id);
const bolgs = ref({ title: '', content: '' }); 
const token = useLocalStorage("token", ""); 

onMounted(() => {
    axios
        .get(`./api/blogs/${id.value}`)
        .then(res => {
            bolgs.value = res.data;
            console.log(bolgs.value);
        })
        .catch(err => console.log(err));
});

const update = () => {
    axios.defaults.headers.common["Authorization"] = token.value;
    axios.post(`./api/blogs/${id.value}`, { 
            title: bolgs.value.title, 
            content: bolgs.value.content,
        })
        .then(res => {
            alertstore.showSuccessToast(res.data.message);
        })
        .catch(err => {
            alertstore.showErrortost(err.response?.data?.error || "An error occurred");
        });
};
</script>

<template>
    <name name="Update Blogs" />
    <div class="bg-gray-100 p-16">
        <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">
                        Edit The Blog
                    </h1>
                    <form class="mb-6">
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                                Title
                            </label>
                            <input
                                type="text"
                                id="title"
                                v-model="bolgs.title"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Please enter a catchy and informative headline for your news article"
                            />
                        </div>
                        <div class="mb-6">
                            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 capitalize">
                                Content
                            </label>
                            <textarea
                                id="body"
                                v-model="bolgs.content"
                                rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Please enter the main body of your news article, providing all relevant details and context."
                            ></textarea>
                        </div>
                        <button
                            @click.prevent="update"
                            class="text-white bg-blue-700 capitalize hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block"
                        >
                            Update Blog
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
