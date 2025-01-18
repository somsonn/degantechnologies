<template>
  <div>
    <!-- Header -->
    <header
      :class="[ 
        'site-header fixed top-0 left-0 w-full z-50 transition-colors duration-300',
        isScrolled ? 'bg-gray-200 text-black shadow-md' : 'bg-white text-black'
      ]"
    >
      <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between relative z-10">
          <!-- Logo Section -->
          <div class="flex items-center flex-wrap space-x-2 md:space-x-4">
            <router-link to="/" class="custom-logo-link" aria-current="page">
              <img
                src="http://127.0.0.1:8000/images/degan.png"
                alt="Degan Logo"
                class="w-16 md:w-20 h-auto"
              />
            </router-link>
            <span class="text-2xl md:text-4xl font-bold text-gray-900 whitespace-nowrap">Degan</span>
            <span class="block text-lg md:text-2xl font-bold text-blue-500 hover:text-blue-700 transition-colors duration-300">Technologies</span>
          </div>

          <!-- Mobile Hamburger Button -->
          <button
            @click="toggleMenu"
            class="lg:hidden p-2 text-gray-900 hover:text-blue-500 focus:outline-none"
            aria-label="Toggle navigation"
          >
            <span v-if="!isMenuOpen" class="material-icons">menu</span>
            <span v-else class="material-icons">close</span>
          </button>

          <!-- Desktop Navigation -->
          <nav id="site-navigation" class="hidden lg:flex lg:space-x-6 text-[20px] font-semibold">
            <ul class="menu flex space-x-6">
              <li>
                <a
                  href="#services-list"
                  @click.prevent="navigateTo('services-list')"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  >Services</a
                >
              </li>
              <li>
                <a
                  href="#products-list"
                  @click.prevent="navigateTo('products-list')"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  >Products</a
                >
              </li>
              <li>
                <router-link
                  to="/portfront"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  @click="closeMenu"
                  >Portfolio</router-link
                >
              </li>
              <li>
                <a
                  href="#blogs"
                  @click.prevent="navigateTo('blogs')"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  >Blogs</a
                >
              </li>
              <li>
                <router-link
                  to="/about"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  >About</router-link
                >
              </li>
              <li>
                <router-link
                  to="/contact"
                  class="hover:bg-blue-900 hover:text-white px-3 py-2 rounded transition-colors duration-300"
                  >Contact Us</router-link
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </header>

    <!-- Mobile Navigation -->
    <div v-if="isMenuOpen" class="mobile-menu fixed top-[60px] left-0 w-full bg-gray-100 shadow-lg z-40">
      <nav class="flex flex-col space-y-4 px-4 py-6">
        <a href="#services-list" @click.prevent="navigateTo('services-list', true)" class="hover:text-blue-500 text-lg font-semibold">Services</a>
        <a href="#products-list" @click.prevent="navigateTo('products-list', true)" class="hover:text-blue-500 text-lg font-semibold">Products</a>
        <router-link to="/portfront" class="hover:text-blue-500 text-lg font-semibold" @click="closeMenu">Portfolio</router-link>
        <a href="#blogs" @click.prevent="navigateTo('blogs', true)" class="hover:text-blue-500 text-lg font-semibold">Blogs</a>
        <router-link to="/about" class="hover:text-blue-500 text-lg font-semibold" @click="closeMenu">About</router-link>
        <router-link to="/contact" class="hover:text-blue-500 text-lg font-semibold" @click="closeMenu">Contact Us</router-link>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const isScrolled = ref(false);
const isMenuOpen = ref(false);

// Handle scroll behavior
const handleScroll = () => {
  isScrolled.value = window.scrollY > 10;
};

// Toggle mobile menu visibility
const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

// Close the menu
const closeMenu = () => {
  isMenuOpen.value = false;
};

// Navigate to a section or a route
const navigateTo = (id, isMobile = false) => {
  if (isMobile) closeMenu(); // Close menu for mobile

  if (["services-list", "products-list", "blogs"].includes(id)) {
    if (router.currentRoute.value.path !== "/") {
      // If not on the home route, navigate to home first
      router.push("/").then(() => {
        setTimeout(() => scrollToSection(id), 200); // Delay scrolling to ensure the page is loaded
      });
    } else {
      scrollToSection(id);
    }
  }
};

// Smooth scroll to section
const scrollToSection = (id) => {
  const section = document.getElementById(id);
  if (section) {
    section.scrollIntoView({ behavior: "smooth", block: "start" });
  }
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});
</script>

<style scoped>
.mobile-menu {
  transition: transform 0.3s ease, opacity 0.3s ease-in-out;
}

.menu li {
  list-style: none;
}

.menu li a {
  display: block;
  padding: 0.5rem 0;
}
</style>
