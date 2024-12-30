<script setup>
import departments from '../dropdowns/departments.vue';
import { ref } from 'vue';

const className = ref('hidden');
const depClass = ref('hidden');

const togglemenu = () => {
    className.value = className.value === 'hidden' ? 'unhidden' : 'hidden';
}


const departmenttogle = () => {
    depClass.value = depClass.value === 'hidden' ? 'unhidden' : 'hidden';
}

</script>
<template>
    <div class=" rounded  w-full  mx-auto  bg-briteblue ">
        <nav class="mb-2 w-fit mx-auto my-auto">
            <div class="text-lg  flex flex-row mt-2 text-green-100 gap-8  justify-between   font-bold">
                <div class="lg:hidden cursor-pointer" @click.prevent="togglemenu">
                    <i class="material-icons align-middle ml-4 text-white">menu</i>
                </div>
                <div class=" lg:flex lg:flex-row w-full" :class="className">
                    <div
                        class=" border-b-2 lg:border-b-0 hover:bg-green-300 hover:rounded  p-2 lg:w-fit   border-white">
                        <a class="px-4 border-b-4 hover:text-briteblue border-darkred" href="#">
                            <span>{{ $t('lang.Home') }}</span>
                        </a>
                    </div>
                    <div @click.prevent="departmenttogle"
                        class="border-b-2 lg:border-b-0 p-2 hover:bg-green-300 hover:rounded   border-white">
                        <a class="px-4  hover:text-briteblue  hover:border-b-4 border-darkred" href="#">
                            <span class="text-one ">{{ $t('lang.Departments') }}</span>
                        </a>
                        <departments :class="depClass" @some-event="departmenttogle" />
                    </div>
                    <div class="border-b-2 lg:border-b-0 p-2 hover:bg-green-300 hover:rounded  border-white">
                        <router-link class="px-4   hover:text-briteblue hover:border-b-4 border-darkred"
                            to="/aboutdeps">
                            <span>{{ $t('lang.aboute us') }}</span>
                        </router-link>
                    </div>
                    <div class="border-b-2 lg:border-b-0 p-2 hover:bg-green-300 hover:rounded  border-white">
                        <router-link class="px-4   hover:text-briteblue hover:border-b-4 border-darkred"
                            to="/Aboutekocha">
                            <span>{{ $t('lang.kocha') }}</span>
                        </router-link>
                    </div>
                    <div class="border-b-2 lg:border-b-0 p-2  hover:bg-green-300 hover:rounded  border-white">
                        <router-link to="/getourwork"
                            class="px-4   hover:text-briteblue hover:border-b-4 border-darkred">
                            <span class="text-one ">{{ $t('lang.our works') }}</span>
                        </router-link>
                    </div>
                    <div class="border-b-2 lg:border-b-0 p-2  hover:bg-green-300 hover:rounded  border-white">
                        <router-link to="/contact" class="px-4   hover:text-briteblue hover:border-b-4 border-darkred">
                            <span class="text-one ">{{ $t('lang.Contact us') }}</span>
                        </router-link>
                    </div>
                    <div class="border-b-2 lg:border-b-0 p-2  hover:bg-green-300 hover:rounded  border-white">
                        <router-link to="/resource" class="px-4   hover:text-briteblue hover:border-b-4 border-darkred">
                            <span>{{ $t('lang.Resource') }}</span>
                        </router-link>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</template>
