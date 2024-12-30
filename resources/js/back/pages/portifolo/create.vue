<script setup>
import name from "../../components/name.vue";
import axios from "axios"
import { useLocalStorage } from "@vueuse/core";
import { ref } from "vue";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const imageUpload = ref(null);
const token = useLocalStorage('token', '');
const 	projectname = ref('');
const description=ref('');

const formData = new FormData();

const selectImage = () => {
    const selectedImage = imageUpload.value.files[0];
    if (selectedImage) {
        formData.append('image', selectedImage);
    }
}

const newsponser = () => {
    formData.append('title', 	projectname.value);
    formData.append('description', 	description.value);
    axios.defaults.headers.common['Authorization'] = token.value;
    axios.post(`./api/portfolios`, formData).then(res => {
        alertstore.showSuccessToast(res.data.message);
        setTimeout(() => {
            projectname.value = '';
            description.value=''
        }, 2000);
    }).catch(err => {
        alertstore.showErrortost(err.response.data.error);
    })
}
</script>
<template>
    <name name="Add New portifolo" />
    <div class="bg-gray-100 p-16">
        <div class="border-2  bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full  bg-white rounded-lg   md:mt-0 xl:p-0 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg  text-sky-700 leading-tight tracking-wide capitalize">Add your portifol</h1>
                    <form class="mb-6">
                        <div class="mb-6">
                            <label for="projectname" class="block mb-2 text-sm font-medium text-gray-900 capitaliz"> Name</label>
                            <input v-model="projectname" type="text" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none"
                                placeholder="	project name of " required>
                        </div>
                       
                        <div class="mb-6">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 capitaliz"> description</label>
                            <input v-model="description" type="text" id="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none"
                                placeholder="	description  " required>
                        </div>
                        <div class="mb-6">
                            <label for="file" class="block mb-2 text-sm font-medium text-gray-900 capitalize">upload portifololo </label>
                            <input accept=".png,.jpg,.jpeg, .gif" type="file" rows="4" ref="imageUpload"
                                @change="selectImage"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none"
                                placeholder="Your question..." />
                        </div>
                        <button @click.prevent="newsponser"
                            class="text-white bg-blue-700 hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 capitalize block">add portifolo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

