<script setup>
import name from "../../components/name.vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";
import { ref, onMounted } from "vue";
import { useAlertsStore } from "../../../store/useAlertsStore";
import { useRoute } from "vue-router";

const alertstore = useAlertsStore();
const route = useRoute();
const token = useLocalStorage('token', '');
const imageUpload = ref(null);
const teamMemberName = ref('');
const position = ref('');
const currentPhoto = ref(null); // To show the current photo
const formData = new FormData();

const fetchTeamMember = () => {
    axios.defaults.headers.common['Authorization'] = token.value;
    axios.get(`/api/team-members/${route.params.id}`)
        .then(res => {
            const data = res.data;
            teamMemberName.value = data.name;
            position.value = data.position;
            currentPhoto.value = data.photo; // Load current photo
        })
        .catch(err => {
            alertstore.showErrortost(err.response?.data?.error || 'Failed to fetch team member details.');
        });
};

const selectImage = () => {
    const selectedImage = imageUpload.value.files[0];
    if (selectedImage) {
        formData.append('photo', selectedImage);
    }
};

const updateTeamMember = () => {
    formData.append('name', teamMemberName.value);
    formData.append('position', position.value);

    axios.defaults.headers.common['Authorization'] = token.value;

    axios.post(`/api/team-members/${route.params.id}?_method=PUT`, formData)
        .then(res => {
            alertstore.showSuccessToast(res.data.message);
        })
        .catch(err => {
            alertstore.showErrortost(err.response?.data?.error || 'Failed to update team member.');
        });
};

onMounted(fetchTeamMember);
</script>

<template>
    <name name="Edit Team Member" />
    <div class="bg-gray-100 p-16">
        <div class="border-2 bg-white border-gray-300 shadow-lg max-w-4xl mx-auto rounded shadow-gray-100">
            <div class="w-full bg-white rounded-lg md:mt-0 xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-lg text-sky-700 leading-tight tracking-wide capitalize">Edit Team Member</h1>
                    <form class="mb-6">
                        <div class="mb-6">
                            <label for="teamMemberName" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Name</label>
                            <input v-model="teamMemberName" type="text" id="teamMemberName"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none"
                                placeholder="Team Member Name" required>
                        </div>
                        <div class="mb-6">
                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Position</label>
                            <input v-model="position" type="text" id="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 outline-none"
                                placeholder="Team Member Position" required>
                        </div>
                        <div class="mb-6">
                            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Current Photo</label>
                            <img :src="`/storage/${currentPhoto}`" alt="Current Photo" class="w-24 h-24 object-cover rounded-lg mb-2">
                        </div>
                        <div class="mb-6">
                            <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 capitalize">Update Photo</label>
                            <input accept=".png,.jpg,.jpeg,.gif" type="file" ref="imageUpload" @change="selectImage"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 outline-none">
                        </div>
                        <button @click.prevent="updateTeamMember"
                            class="text-white bg-blue-700 hover:bg-blue-800 w-fit mx-auto focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none capitalize block">Update Team Member</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
