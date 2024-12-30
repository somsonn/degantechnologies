<script setup>
import { onMounted , ref} from "vue";
import axios from "axios";

const sponsers = ref([]);
onMounted(async () => {
    await axios.get('./api/getall/sponser').then(res => {
        sponsers.value = res.data;
    }).catch(err => console.log(err));
});
</script>

<template>
    <div class="m-16">
        <div class="text-center">
                    <h1 class="mt-4 text-3xl font-bold text-darkred sm:text-4xl xl:text-5xl font-pj"> Partners</h1>
                </div>
        <div class="grid grid-cols-2 mt-16 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 m-8 gap-4  justify-center">
            <div class=" w-fit flex "  v-for="sponser in sponsers" :key="sponser.id">
                <img :src="sponser.image" alt="" class=" h-16 object-cover">
        
            </div>
        </div>
    </div>
</template>