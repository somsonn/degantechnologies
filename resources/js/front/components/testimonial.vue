<script setup>
import { onMounted, ref, computed } from "vue";
import axios from "axios";
const perPage = ref(3);
const currentPage = ref(1);
const currenteventpage = ref(1);
const testimonial = ref([]);
onMounted(async () => {
  await axios
    .get(`./api/getall/testimonial`)
    .then((res) => {
      testimonial.value = res.data;
    })
    .catch((err) => console.log(err));
});

const paginatedData = computed(() => {
  const start = (currentPage.value - 1) * perPage.value;
  const end = start + perPage.value;
  return testimonial.value.slice(start, end);
});

const totalPages = computed(() =>
  Math.ceil(testimonial.value.length / perPage.value)
);
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
    <div class="py-12 sm:py-16 bg-gray-100 lg:py-20">
        <div class="px-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col items-center">
                <div class="text-center">
                    <h2 class="mt-4 text-3xl font-bold text-darkred sm:text-4xl xl:text-5xl font-pj">
                        Our Testimonial
                    </h2>
                </div>
                ``

                <div class="relative mt-10 md:mt-16 md:order-2 align-middle gap-2 flex flex-row">
                    <button
                        class="pagnations h-fit cursor-pointer align-middle my-auto hover:bg-gray-300 active:text-darkred text-4xl font-bold"
                        @click="previouseventpage" :disabled="currenteventpage === 1">
                        <i class="material-icons text-darkblue font-xl">keyboard_double_arrow_left</i>
                    </button>
                    <div
                        class="relative grid max-w-lg grid-cols-1 gap-6 mx-auto md:max-w-none lg:gap-10 md:grid-cols-2 lg:grid-cols-3">
                        <div class="flex flex-col overflow-hidden shadow-xl" v-for="test in paginatedData"
                            :key="test.id">
                            <div class="flex flex-col flex-1 p-6 bg-white lg:py-8 lg:px-7">
                                <div class="flex-1">
                                    <blockquote class="flex-1 mt-8">
                                        <p class="text-lg leading-relaxed text-gray-900 font-normal text-center">
                                            “{{ test.discribution }}”
                                        </p>
                                    </blockquote>
                                    <div class="flex items-center justify-center m-10">
                                        <img :src="test.image" alt=""
                                            class="flex-shrink-0 object-cover rounded-full w-24 h-24 mt-2" />
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <div v-for="star in [1, 2, 3, 4, 5]" :key="star">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960"
                                                class="w-5 h-5 text-yellow-500">
                                                <path fill="currentColor"
                                                    d="m233 976 65-281L80 506l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-center">
                                            <p class="text-base font-bold my-auto text-darkblue capitalize font-pj">
                                                {{ test.Name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="pagnations h-fit cursor-pointer align-middle my-auto hover:bg-gray-300 active:text-darkred"
                        @click="nexeventpage" :disabled="currenteventpage === totaleventpages">
                        <i class="material-icons text-darkblue font-xl">double_arrow</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


