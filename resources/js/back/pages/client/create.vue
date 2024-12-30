<script setup>
import name from "../../components/name.vue";
import axios from "axios";
import { ref } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertStore = useAlertsStore();
const clientName = ref('');
const clientLogo = ref(null); // Image file reference
const clientWebsite = ref('');

const token = useLocalStorage('token', '');

const formData = new FormData();

const selectImage = () => {
    const selectedImage = clientLogo.value.files[0];
    if (selectedImage) {
        formData.append('logo', selectedImage);
    }
};

const post = () => {
    formData.append('name', clientName.value);
    formData.append('website', clientWebsite.value);
    axios.defaults.headers.common['Authorization'] = token.value;
    axios.post('./api/clients', formData)
        .then(res => {
            alertStore.showSuccessToast(res.data.message);
            setTimeout(() => {
                clientName.value = '';
                clientWebsite.value = '';
                clientLogo.value = null;
            }, 2000);
        })
        .catch(err => {
            alertStore.showErrortost(err.response.data.error);
        });
};
</script>

<template>
    <name name="Add New Client" />
    <div class="bg-gray-100 p-16">
        <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">Fill Client Information</h1>
                    <form class="mb-6">
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Client Name</label>
                            <input type="text" id="name" v-model="clientName" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Please enter client name" />
                        </div>

                        <div class="mb-6">
                            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Client Website</label>
                            <input type="text" id="website" v-model="clientWebsite" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none" placeholder="Please enter client website URL" />
                        </div>
                        <div class="mb-6">
                            <label for="logo" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Client Logo</label>
                            <input accept=".png,.jpg,.jpeg,.gif" type="file" ref="clientLogo" @change="selectImage" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none" />
                        </div>
                        <button @click.prevent="post" class="text-white bg-blue-700 hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg capitalize text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 block">Add Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
