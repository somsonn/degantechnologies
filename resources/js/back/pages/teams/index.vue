<script setup>
import axios from "axios";
import { onMounted, ref, computed } from "vue";
import succs from "../conformation/succ.vue";
import errs from "../conformation/err.vue";
import name from "../../components/name.vue";
import { useLocalStorage } from "@vueuse/core";
import { useAlertsStore } from "../../../store/useAlertsStore";

const alertstore = useAlertsStore();
const token = useLocalStorage('token', '');
const teamMembers = ref([]);
const removedTeamMemberIds = ref([]);
const countTeamMembers = ref(0);
const succ = ref('');
const err = ref('');
const perPage = ref(5);
const currentPage = ref(1);
const keywords = ref('');

function getAllTeamMembers() {
    axios.get('./api/team-members').then(res => {
        teamMembers.value = res.data;
    }).catch(err => console.log(err));
}

onMounted(async () => {
    await getAllTeamMembers();
});

function countTrashTeamMembers(id) {
    if (removedTeamMemberIds.value.includes(id)) {
        removedTeamMemberIds.value = removedTeamMemberIds.value.filter(singleId => singleId !== id);
        countTeamMembers.value = removedTeamMemberIds.value.length;
    } else {
        removedTeamMemberIds.value.push(id);
        countTeamMembers.value = removedTeamMemberIds.value.length;
    }
}

const hideTeamMember = () => {
    axios.defaults.headers.common['Authorization'] = token.value;
    axios.post('./api/team-members/hidden', { id: removedTeamMemberIds.value }).then(res => {
        alertstore.showSuccessToast(res.data.message);
        getAllTeamMembers();
        setTimeout(() => {
            removedTeamMemberIds.value = [];
            countTeamMembers.value = 0;
        }, 2000);
    }).catch(error => {
        alertstore.showErrortost(error.message.data.error);
    });
};

const deleteTeamMember = async (id) => {
    axios.defaults.headers.common["Authorization"] = token.value;
    await axios.delete(`./api/team-members/${id}`)
        .then(res => {
            alertstore.showSuccessToast(res.data.message);
            teamMembers.value = teamMembers.value.filter(member => member.id !== id);
        })
        .catch(error => {
            alertstore.showErrortost(error.response.data.error);
        });
};

const searching = computed(() => {
    const keyword = keywords.value.toLowerCase();
    return teamMembers.value.filter(member => member.name.toLowerCase().includes(keyword));
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
        <name name="Team Members" />
        <succs v-if="succ" :succ="succ" />
        <errs v-if="err" :err="err" />
        <div class="m-4 mt-12 rounded">
            <div class="w-full bg-white border-b-2 rounded border-gray-200 flex flex-row justify-between">
                <h1 class="font-bold text-gray-500 text-lg p-4">Team Members List</h1>
                <router-link to="/teampost"
                    class="w-fit text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 m-4 text-center">
                    Add Team Member
                </router-link>
            </div>
            <!-- Table starts here -->
            <div class="flex bg-white flex-col items-center justify-center">
                <div class="w-full relative p-2 overflow-x-auto shadow-md sm:rounded-lg xs:p-5">
                    <div
                        class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                        <div v-if="countTeamMembers" class="align-middle">
                            <p>
                                <span class="text-blue-500 w-4 h-4 bg-gray-200 rounded-full p-2 font-bold">
                                    {{ countTeamMembers }}
                                </span>
                                row(s) selected
                                <i @click.prevent="hideTeamMember"
                                    class="material-icons text-xl font-extrabold w-10 h-10 hover:bg-gray-400 text-center p-2 bg-gray-200 rounded-full text-red-500">
                                    delete
                                </i>
                            </p>
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <input v-model="keywords" type="text" id="table-search"
                                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-sky-500 focus:border-sky-500 outline-none"
                                placeholder="Search for team members">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Mark</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Position</th>
                                <th scope="col" class="px-6 py-3">Photo</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody v-for="member in paginatedData" :key="member.id">
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td @click.prevent="countTrashTeamMembers(member.id)" class="w-4 p-4">
                                    <div class="border-4 border-gray-200 text-center rounded w-5 h-5">
                                        <p v-if="removedTeamMemberIds.includes(member.id)">
                                            <i class="material-icons text-2xl font-bold text-green-600">done</i>
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ member.name }}</td>
                                <td class="px-6 py-4">{{ member.position }}</td>
                                <td class="px-6 py-4">
                                    <img :src="member.photo" class="w-16 h-10 object-cover" alt="team-photo">
                                </td>
                                <td>
                                    <router-link :to="{ name: 'editTeamMember', params: { id: member.id } }"
                                        class="text-lg text-blue-700 hover:text-sky-800">Edit</router-link>
                                    <button type="button" class="text-lg text-red-700 hover:text-sky-800"
                                        @click="deleteTeamMember(member.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="perPage >= 5" class="w-full justify-center gap-2 flex flex-row pt-4">
                        <div><button
                                class="shadow p-2 bg-gray-200 active:text-red-500 hover:bg-gray-300 text-briteblue text-lg font-bold rounded"
                                @click="prevPage" :disabled="currentPage === 1">Back</button></div>
                        <div><button
                                class="shadow p-2 bg-gray-200 text-briteblue hover:bg-gray-300 text-lg font-bold rounded">
                                Page {{ currentPage }}</button></div>
                        <div><button
                                class="shadow p-2 bg-gray-200 active:text-red-500 text-briteblue hover:bg-gray-300 text-lg font-bold rounded"
                                @click="nextPage" :disabled="currentPage === totalPages">Next</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
