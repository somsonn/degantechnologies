<script setup>
import lang from './lang.vue';

</script>
<template>
    <div class="border-b-2  w-full  bg-briteblue border-green-100 top-0">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-fit ">
                <div class="text-sm text-sky-800 font-semibold py-1">
                    <a href="#" class="hover:text-green-400 hidden sm:flex text-lg text-yellow-200 font-normal gap-2 py-1"><span>
                            Kombolcha Ethiopia, </span><span class="pl-2">kochinvest12@gmail.com,</span>
                        <span class="pl-2">033-3519009/2933</span></a>
                </div>
            </div>
            <div class="w-full md:w-fit ">
                <ul class="flex flex-wrap text-white list-none md:justify-end  justify-center">
                    <li>
                        <a href="#" class=" hover:text-green-400 text-sm font-semibold block py-1 px-3">{{
                            $t('lang.Telegram') }}</a>
                    </li>
                    <li>
                        <a href="#" class=" hover:text-green-400 text-sm font-semibold block py-1 px-3">{{
                            $t('lang.Facebook') }}</a>
                    </li>
                    <li>
                        <a href="#" class=" hover:text-green-400 text-sm font-semibold block py-1 px-3">{{
                            $t('lang.Instagram') }}</a>
                    </li>
                    <li>
                        <a href="#" class=" hover:text-green-400 text-sm font-semibold block py-1 px-3">{{
                            $t('lang.Twitter') }}</a>
                    </li>
                    <li class="pl-4">
                        <lang />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>