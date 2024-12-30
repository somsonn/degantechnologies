import { createApp } from "vue";
import App from "./app.vue";
import router from "./router";
import i18n from "../langs/i18n";
import Vue3Toasity from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { createPinia } from "pinia";

const app = createApp(App);
const pinia = createPinia();
app.use(i18n);
app.use(Vue3Toasity, {
    autoClose: 3000,
});
app.use(pinia);
app.use(router);
app.mount("#app");
