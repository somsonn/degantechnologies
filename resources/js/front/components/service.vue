<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useLocalStorage } from "@vueuse/core";

import {
  ArrowRightIcon,
  CogIcon,
  BriefcaseIcon,
  SupportIcon,
  MegaphoneIcon,
  CloudIcon,
} from "@heroicons/vue/solid";

const token = useLocalStorage("token", "");
const services = ref([]);
const isExpanded = ref(false);

const fetchService = async () => {
  try {
    axios.defaults.headers.common["Authorization"] = token.value;
    const response = await axios.get("./api/contents/type/services");
    services.value = response.data.data;
  } catch (err) {
    console.error(err);
  }
};

const toggleExpand = () => {
  isExpanded.value = !isExpanded.value;
};

onMounted(() => {
  fetchService();
});
</script>
<template>
  <section id="services-list">
    <div class="our_service bg-white py-12">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between items-center">
          <div class="our_service_content w-full lg:w-1/2">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">
              <span class="text-blue-500">01</span> OUR SERVICES
            </h2>
            <ul class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <li
                v-for="(service, index) in services"
                :key="index"
                class="flex items-start gap-6 p-4 hover:bg-blue-50 rounded-lg transition-all duration-300 ease-in-out"
              >
                <div class="icon-container">
                  <template v-if="service.title === 'Software Development Services'">
                    <ArrowRightIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else-if="service.title === 'Tech Maintenance and Support'">
                    <CogIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else-if="service.title === 'Business Consulting'">
                    <BriefcaseIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else-if="service.title === 'IT Support'">
                    <SupportIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else-if="service.title === 'Digital Marketing'">
                    <MegaphoneIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else-if="service.title === 'Cloud Services'">
                    <CloudIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>

                  <template v-else>
                    <CogIcon
                      class="text-blue-500 w-14 h-14 transform hover:scale-110 transition-all duration-300 ease-in-out"
                    />
                  </template>
                </div>

                <div>
                  <h3
                    class="text-lg font-semibold text-gray-800 hover:text-blue-500 transition-colors"
                  >
                    <a
                      :href="service.link || '#'"
                      class="transition-all duration-200 ease-in-out"
                    >
                      {{ service.title }}
                    </a>
                  </h3>
                  <p class="text-gray-600 mt-2">
                    {{ service.description }}
                  </p>
                </div>
              </li>
            </ul>

            <div v-if="isExpanded" class="mt-4 text-gray-700">
              <p>
                At Degan Technologies, we specialize in delivering Software Development
                Services that cover the end-to-end development of custom software tailored
                to meet your specific business needs. Whether you're looking to build a
                brand-new solution or enhance an existing one, our team of experienced
                developers ensures that the software we create is robust, scalable, and
                designed to grow with your business. In addition to software development,
                we provide Tech Maintenance and Support to ensure that your systems
                operate at their best long after the initial deployment. Our comprehensive
                support services include ongoing system optimization, troubleshooting, and
                proactive technical assistance, allowing you to focus on your business
                while we take care of the technology. With our end-to-end solutions, you
                can be confident that your technology infrastructure will remain
                efficient, secure, and up to date.
              </p>
            </div>
            <div class="mt-8">
              <button
                @click="toggleExpand"
                class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition-all duration-300 ease-in-out transform hover:scale-105"
              >
                {{ isExpanded ? "Collapse Text" : "Our Services" }}
              </button>
            </div>
          </div>

          <div class="w-full lg:w-1/2 mt-8 lg:mt-0">
            <img
              class="w-full h-auto rounded-lg shadow-lg object-cover transform hover:scale-105 transition-all duration-300 ease-in-out"
              src="servicelogo.jpg"
              alt="Our Services"
            />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
