<script setup>
import subscribe from "./subscrib.vue";
</script>

<template>
  <div></div>
  <footer class="relative w-full font-roboto bottom-0 bg-cyan-950 pb-4">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
        <!-- ABOUT US -->
        <div class="col">
          <ul class="flex flex-col list-none md:justify-end justify-center">
            <!-- New Footer Element -->
            <li>
              <a
                href="#"
                class="text-blue-400 hover:text-blue-200 text-xl font-extrabold block uppercase py-5 px-3"
              >
                {{ $t("lang.aboute us") }}
              </a>
            </li>
            <!-- ABOUT KOMBOLCHA INDUSTRY and INVESTMENT DEPARTMENT -->
            <router-link to="/about">
              <div>
                <h3 class="text-white text-sm font-extrabold block py-3 px-3">
                  {{ $t("lang.company") }}
                </h3>
              </div>
              <li>
                <a
                  class="text-gray-300 hover:text-white text-sm font-medium block py-1 px-3"
                  >{{ $t("lang.Overview") }}</a
                >
              </li>
              <li>
                <a
                  class="text-gray-300 hover:text-white text-sm font-medium block py-1 px-3"
                  >{{ $t("lang.Mission") }}</a
                >
              </li>
              <li>
                <a
                  class="text-gray-300 hover:text-white text-sm font-medium block py-1 px-3"
                  >{{ $t("lang.Vision") }}</a
                >
              </li>
            </router-link>
          </ul>
        </div>

        <!-- SERVICE AND PRODUCTS -->
        <div class="col">
          <router-link to="/getourwork">
            <ul class="flex flex-col list-none md:justify-end justify-center">
              <!-- Services and Products Section -->
              <li>
                <a
                  href="#"
                  class="text-blue-400 hover:text-blue-200 text-lg font-extrabold block uppercase py-5 px-3"
                >
                  {{ $t("lang.service") }}
                </a>
              </li>

              <!-- Service List -->
              <div>
                <h3
                  class="text-white text-sm font-extrabold block py-3 px-3 uppercase"
                ></h3>
              </div>
              <li>
                <a
                  href="#"
                  class="text-gray-100 hover:text-white text-sm font-extrabold block py-2 px-3"
                  >Software Development Services</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-300 hover:text-white text-sm font-extrabold block py-1 px-3"
                  >Tech Maintenance and Support</a
                >
              </li>

              <!-- Product List -->
              <div>
                <h3 class="text-white text-sm font-extrabold block py-3 px-3"></h3>
              </div>
              <li>
                <a
                  href="#"
                  class="text-gray-100 hover:text-white text-sm font-extrabold block py-1 px-3"
                  >Enterprise Software Systems</a
                >
              </li>
              <li>
                <a
                  href="#"
                  class="text-gray-100 hover:text-white text-sm font-extrabold block py-1 px-3"
                  >Mobile and Web Applications</a
                >
              </li>
            </ul>
          </router-link>
        </div>

        <!-- CONTACT US -->
        <div class="col">
          <ul class="flex flex-col list-none md:justify-end justify-center">
            <!-- Departments  Element -->
            <li>
              <a
                href="#"
                class="text-blue-400 hover:text-blue-200 text-lg font-extrabold uppercase block py-5 px-3"
              >
                {{ $t("lang.Contact us") }}
              </a>
            </li>
            <li>
              <router-link
                to="/"
                class="text-gray-100 hover:text-white text-sm font-extrabold block py-1 px-3"
              >
                {{ $t("lang.phonne") }}</router-link
              >
            </li>
            <li>
              <router-link
                to="/"
                class="text-gray-100 hover:text-white text-sm font-extrabold block py-1 px-3"
              >
                {{ $t("lang.emaill") }}</router-link
              >
            </li>
            <li></li>
          </ul>
          <div
            class="flex flex-col items-start md:justify-between justify-center py-5 px-1"
          >
            <div class="w-full md:w-11/12 px-1 py-5">
              <h2 class="text-white text-xl font-bold px-1 py-1">
                {{ $t("lang.join us") }}
              </h2>
              <p class="text-white text-lg font-medium px-1 py-2">
                {{ $t("lang.email and subscribe") }}
              </p>
            </div>
            <subscribe />
          </div>
        </div>
      </div>

      <!-- Social Media Section -->
      <div
        class="flex flex-col items-end bg-cyan-950 md:justify-between justify-end py-1"
      >
        <div class="w-full md:w-4/12 px-4">
          <h2 class="text-white text-sm font-bold px-18 py-3">
            {{ $t("lang.follow us") }} :
          </h2>
        </div>
        <div class="w-full bg-cyan-950 px-4">
          <ul class="flex flex-wrap list-none md:justify-end justify-center">
            <li>
              <a
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/"
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3"
              >
                <i class="fab fa-telegram"></i> {{ $t("lang.Telegram") }}
              </a>
            </li>
            <li>
              <a
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/"
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3"
              >
                <i class="fab fa-facebook"></i> {{ $t("lang.Facebook") }}
              </a>
            </li>
            <li>
              <a
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/"
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3"
              >
                <i class="fab fa-instagram"></i> {{ $t("lang.Instagram") }}
              </a>
            </li>
            <li>
              <a
                href="https://www.facebook.com/p/Kombolcha-industry-and-investment-department-100080887707066/"
                class="text-white hover:text-gray-400 text-sm font-semibold py-1 px-3"
              >
                <i class="fab fa-twitter"></i> {{ $t("lang.Twitter") }}
              </a>
            </li>
          </ul>
        </div>
      </div>

      <hr class="mb-6 border-b-1 border-gray-700" />

      <div
        class="flex flex-wrap items-center md:justify-between bg-cyan-950 justify-center"
      >
        <div class="w-full md:w-4/12 px-4">
          <div class="text-sm text-white font-semibold py-1">
            Copyright ©
            <a href="#" class="text-white hover:text-gray-400 text-sm font-semibold py-1"
              >Degan software company</a
            >
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
