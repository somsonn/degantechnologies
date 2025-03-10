<script setup>
import axios from "axios";
import { ref } from "vue";
import { useAlertsStore } from "../../store/useAlertsStore";

const alert = useAlertsStore();
const question = ref('');
const email = ref('');
const phone_no = ref('');

const formData = new FormData();

const ask = () => {
  formData.append('question', question.value);
  formData.append('email', email.value);
  formData.append('phone_no', phone_no.value);
  axios.post('./api/question/store', formData).then(res => {
    alert.showSuccessToast(res.data.message)
    setTimeout(() => {
      email.value = '';
      phone_no.value = '';
      question.value = '';
    }, 2000);
  }).catch(res => {
    alert.showErrortost(res.response.data.error)
  })
}
</script>

<template>
  <div class="max-w-lg mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg border border-gray-200">
    <h1 class="text-center text-lg text-sky-700 font-semibold mb-6">Ask Your Question</h1>

    <form @submit.prevent="ask">
      <div class="space-y-4">
        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="email" type="email" id="email" 
            class="w-full p-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Your email" required>
        </div>

        <!-- Phone Field -->
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Phone number</label>
          <input v-model="phone_no" type="text" id="phone"
            class="w-full p-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="Your phone number" required>
        </div>

        <!-- Question Field -->
        <div>
          <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
          <textarea v-model="question" id="message" rows="4"
            class="w-full p-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Your question..." required></textarea>
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit" 
            class="w-full p-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Submit
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<style scoped>
/* Optional: Add any custom styles for more advanced styling */
</style>
