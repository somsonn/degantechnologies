<script setup> 
import { ref, onMounted } from "vue"; 
import subscribe from "./subscrib.vue"; 
 
const currentYear = ref(new Date().getFullYear()); 
 
onMounted(() => { 
  setInterval(() => { 
    currentYear.value = new Date().getFullYear(); 
  }, 1000 * 60 * 60 * 24); 
}); 
</script> 
 
<template> 
  <footer class="relative w-full mt-3 font-roboto bottom-0 bg-cyan-950 pb-2"> 
    <div class="container  mx-auto px-4"> 
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2"> 
        <!-- ABOUT US --> 
        <div class="col"> 
          <ul class="flex flex-col list-none md:justify-end justify-center"> 
            <li> 
              <a 
                href="about" 
                class="text-blue-400 hover:text-blue-200 text-xl font-extrabold block uppercase py-5 px-3" 
              > 
                About Us 
              </a> 
            </li> 
            <router-link to="/about"> 
              <div> 
                <h3 class="text-white text-sm font-extrabold block py-3 px-3">Company</h3> 
              </div> 
            </router-link> 
            <router-link to="about"> 
              <router-link to="about"> 
                <li> 
                  <a 
                    class="text-gray-300 hover:text-white text-sm font-bold block py-1 px-3" 
                    >Mission</a 
                  > 
                </li> 
              </router-link> 
              <li> 
                <a 
                  class="text-gray-300 hover:text-white text-sm font-bold block py-1 px-3" 
                  >Vision</a 
                > 
              </li> 
            </router-link> 
          </ul> 
        </div> 
 
        <!-- SERVICE AND PRODUCTS --> 
        <div class="col"> 
          <ul class="flex flex-col list-none md:justify-end justify-center"> 
            <li> 
              <a 
                href="#" 
                class="text-blue-400 hover:text-blue-200 text-lg font-extrabold block uppercase py-5 px-3" 
              > 
                Services 
              </a> 
            </li> 
            <div> 
              <h3 
                class="text-white text-sm font-extrabold block py-3 px-3 uppercase" 
              ></h3> 
            </div> 
 
            <router-link to="servicefront"> 
              <li> 
                <a 
                  href="" 
                  class="text-gray-100 hover:text-white text-sm font-bold block py-2 px-3" 
                  >Software Development Services</a 
                > 
              </li> 
            </router-link> 
 
            <router-link to="servicefront"> 
              <li> 
                <a 
                  href="" 
                  class="text-gray-100 hover:text-white text-sm font-bold block py-2 px-3" 
                  >Tech Maintenance and Support</a 
                > 
              </li> 
            </router-link> 
 
            <div> 
              <h3 class="text-white text-sm font-extrabold block py-3 px-3"></h3> 
            </div> 
            <router-link to="/productfront" 
              ><li> 
                <a 
                  href="#" 
                  class="text-gray-100 hover:text-white text-sm font-bold block py-1 px-3" 
                  >Enterprise Software Systems</a 
                > 
              </li></router-link 
            > 
            <router-link to="/productfront"> 
              <li> 
                <a 
                  href="#" 
                  class="text-gray-100 hover:text-white text-sm font-bold block py-1 px-3" 
                  >Mobile and Web Applications</a 
                > 
              </li></router-link 
            > 
          </ul> 
        </div> 
 
        <div class="col"> 
          <ul class="flex flex-col list-none md:justify-end justify-center"> 
            <router-link to="contact" 
              ><li> 
                <a 
                  href="#" 
                  class="text-blue-400 hover:text-blue-200 text-lg font-extrabold uppercase block py-5 px-3" 
                > 
                  Contact Us 
                </a>
</li></router-link 
            > 
            <li> 
              <router-link 
                to="/" 
                class="text-gray-100 hover:text-white text-sm font-bold block py-1 px-3" 
              > 
                Phone : +251922687847</router-link 
              > 
            </li> 
            <li> 
              <router-link 
                to="/" 
                class="text-gray-100 hover:text-white text-sm font-bold block py-1 px-3" 
              > 
                Email: degantechnologies@gmail.com</router-link 
              > 
            </li> 
          </ul> 
          <div 
            class="flex flex-col items-start md:justify-between justify-center py-5 px-1" 
          > 
            <div class="w-full md:w-11/12 px-1 py-4"> 
              <h2 class="text-white text-xl font-bold px-1 py-1">Join Us</h2> 
              <p class="text-white text-lg font-medium px-1 py-2"> 
                Subscribe with your email 
              </p> 
            </div> 
            <subscribe /> 
          </div> 
        </div> 
      </div> 
 
      <!-- Social Media Section --> 
      <div class="flex flex-wrap items-center justify-center bg-cyan-950 py-2"> 
        <div class="w-full bg-cyan-950 px-4"> 
          <ul class="flex flex-wrap list-none md:justify-end justify-center"> 
            <li> 
              <a 
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/" 
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3" 
              > 
                <i class="fab fa-telegram"></i> Telegram 
              </a> 
            </li> 
            <li> 
              <a 
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/" 
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3" 
              > 
                <i class="fab fa-facebook"></i> Facebook 
              </a> 
            </li> 
            <li> 
              <a 
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/" 
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3" 
              > 
                <i class="fab fa-instagram"></i> Instagram 
              </a> 
            </li> 
            <li> 
              <a 
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/" 
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3" 
              > 
                <i class="fab fa-twitter"></i> Twitter 
              </a> 
            </li> 
          </ul> 
        </div> 
      </div> 
 
      <!-- Copyright Section --> 
      <div class="w-full text-center bg-cyan-950 py-3"> 
        <span class="text-white text-sm font-semibold"> 
          Copyright © {{ currentYear }} 
          <a href="#" class="text-white hover:text-gray-400"> Degan Software Company </a> 
        </span> 
      </div> 
    </div> 
  </footer> 
</template>