<script setup>
import { ref } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../store/useAlertsStore";
const alertstore = useAlertsStore();
const token = useLocalStorage('token', '');
const title = ref('');
const description = ref('');
const year = ref('');
const companylogo = ref(null); 

const formData = new FormData();

const selectImage = () => {
    const selectedImage = companylogo.value.files[0];
    if (selectedImage) {
        formData.append('image', selectedImage);
    }
};

const post = () => {
    formData.append('title', title.value);
    formData.append('description', description.value);
    formData.append('year', year.value);
    axios.defaults.headers.common['Authorization'] = token.value;
    axios.post('./api/company-histories', formData)
        .then(res => {
            alertstore.showSuccessToast(res.data.message);
            setTimeout(() => {
                title.value = '';
                description.value = '';
                year.value = '';
            }, 2000);
        })
        .catch(err => {
            alertstore.showErrortost(err.response.data.error);
        });
};
</script>

<template>
    <name name="Add New company" />
    <div class="bg-gray-100 p-16">
        <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">Fill company Information</h1>
                    <form @submit.prevent="post" class="mb-6">
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Title</label>
                            <input
                                type="text"
                                id="title"
                                v-model="title"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Please enter title"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Description</label>
                            <textarea
                                id="description"
                                v-model="description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Please enter description"
                            ></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Year</label>
                            <input
                                type="date"
                                id="year"
                                v-model="year"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Please enter year"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 capitalize">company Logo</label>
                            <input
                                accept=".png,.jpg,.jpeg,.gif"
                                type="file"
                                ref="clientLogo"
                                @change="selectImage"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                            />
                        </div>

                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg capitalize text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block"
                        >
                            Add company
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
