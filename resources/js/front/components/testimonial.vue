<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

// Define the testimonials as a reactive variable
const testimonials = ref([]);

// Fetch the testimonials data from the API on component mount
onMounted(() => {
  axios.get('/api/team-members')
    .then(response => {
      // Map the response data to the testimonials array
      testimonials.value = response.data.data.map(teamMember => ({
        id: teamMember.id,
        description: teamMember.position, // Assuming 'position' is the description
        image: teamMember.photo, // Assuming 'photo' contains the image URL
        name: teamMember.name,  // Assuming 'name' is the team member's name
        stars: 5,  // You can adjust the stars based on another field in the model, if required
      }));
    })
    .catch(error => {
      console.error("Error fetching team members:", error);
    });
});
</script>

<template>
  <div class="py-12 bg-gradient-to-r from-blue-50 to-indigo-100">
    <div class="px-6 mx-auto max-w-7xl">
      <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold text-darkblue sm:text-5xl">
          Our Testimonials
        </h2>
        <p class="mt-4 text-lg text-gray-700">
          What makes us stand out? Let our customers tell you.
        </p>
      </div>

      <!-- Testimonials -->
      <div class="flex overflow-hidden space-x-6">
        <!-- Cards (3 testimonials visible at a time) -->
        <div 
          v-for="testimonial in testimonials" 
          :key="testimonial.id" 
          class="flex-shrink-0 w-1/3"
        >
          <div 
            class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:scale-105 transform transition"
          >
            <img 
              :src="testimonial.image" 
              alt="User"
              class="w-24 h-24 rounded-full border-4 border-gray-300"
            />
            <blockquote class="mt-6 text-center text-gray-800 italic">
              “{{ testimonial.description }}”
            </blockquote>
            <div class="flex justify-center mt-4">
              <div v-for="star in 5" :key="star" class="mr-1">
                <svg 
                  xmlns="http://www.w3.org/2000/svg" 
                  viewBox="0 96 960 960" 
                  class="w-5 h-5"
                  :class="{ 
                    'text-yellow-500 animate-pulse': star <= testimonial.stars, 
                    'text-gray-300': star > testimonial.stars, 
                  }"
                >
                  <path 
                    fill="currentColor" 
                    d="m233 976 65-281L80 506l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Z"
                  />
                </svg>
              </div>
            </div>
            <div class="mt-6 text-center">
              <p class="text-lg font-semibold text-darkblue capitalize">
                {{ testimonial.name }}
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>
