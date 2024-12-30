<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { useRoute } from "vue-router";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const route = useRoute();
const historyId = route.params.id;
const token = useLocalStorage('token', '');

const title = ref('');
const description = ref('');
const imageUpload = ref(null);

onMounted(() => {
    axios.get(`/api/company_historys/${historyId}`)
        .then(res => {
            title.value = res.data.title;
            description.value = res.data.description;
        })
        .catch(err => alertstore.showErrortost(err.response?.data?.error || "An error occurred"));
});

const updateHistory = () => {
    const formData = new FormData();
    formData.append('title', title.value);
    formData.append('description', description.value);
    if (imageUpload.value?.files[0]) {
        formData.append('image', imageUpload.value.files[0]);
    }

    axios.defaults.headers.common['Authorization'] = token.value;
    axios.post(`/api/company_historys/${historyId}`, formData)
        .then(res => alertstore.showSuccessToast(res.data.message))
        .catch(err => alertstore.showErrortost(err.response?.data?.error || "An error occurred"));
};
</script>

<template>
    <div>
        <h2>Edit Company History</h2>
        <form @submit.prevent="updateHistory">
            <input v-model="title" type="text" placeholder="Title" required />
            <textarea v-model="description" placeholder="Description" required></textarea>
            <input type="file" ref="imageUpload" accept="image/*" />
            <button type="submit">Update</button>
        </form>
    </div>
</template>
