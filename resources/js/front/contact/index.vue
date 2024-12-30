<script setup>
import contactform from "./contactus.vue";
import googlemap from "./googlemap.vue";
</script>

<template>
  <div class="grid md:grid-cols-2 mt-16 md:m-16 gap-8">
    <div class="col-span-1 justify-center ">
      <div class="md:p-16">
        <h1 class="font-bold text-4xl text-sky-600 md:p-4">How Can We Help You?</h1>
        <p> 
          
        You Can Ask Question and Get Response Through Your Email From Department Head</p>
      </div>
    </div>
    <div class="col-span-1  font-roboto ">
    <contactform class="col-span-1 justify-center" />
  </div>
  </div>
  <div>
      <googlemap/>
  </div>
</template>