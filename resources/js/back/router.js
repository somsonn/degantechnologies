import { createRouter, createWebHashHistory } from "vue-router";
import Auth from "../login/auth";
import adminPage from "./back.vue";
import dashbord from "./index.vue";

// Import routes for admin and front pages
import Blogs from "./pages/Blogs/index.vue";
import BlogDetail from "../front/components/BlogDetail.vue";
import post from "./pages/Blogs/create.vue";
import edit from "./pages/Blogs/edit.vue";

import portifol from "./pages/portifolo/index.vue";
import portifolos from "./pages/portifolo/create.vue";
import editportifolos from "./pages/portifolo/edit.vue";

import teamindex from "./pages/teams/index.vue";
import teampost from "./pages/teams/create.vue";
import teamsedit from "./pages/teams/edit.vue";

import clientpost from "./pages/client/create.vue";
import clientindex from "./pages/client/index.vue";
import clientedit from "./pages/client/edit.vue";

import frontPage from "../front/frontPage.vue";
import mainPage from "../front/index.vue";
import contact from "../front/contact/index.vue";
import about from "../front/components/about/index.vue";
import portfront from "../front/components/portifolo.vue";
import portfolioDetail from "../front/components/portfolioDetail.vue"

import login from "../login/loginPage.vue";
import changePassword from "../login/changeePassword.vue";

import servicefront from "../front/components/service.vue" 
import productfront from "../front/components/product.vue" 
const routes = [
  // Admin routes
  {
    path: "/adminPage",
    name: "adminPage",
    component: adminPage,
    children: [
      { path: "/dashbord", name: "dashbord", component: dashbord },
      { path: "/Blogs", name: "Blogs", component: Blogs },
      { path: "/post", name: "post", component: post },
      { path: "/edit/:id", name: "edit", component: edit },
      { path: "/portifolos", name: "portifolos", component: portifolos },
      { path: "/portifol", name: "portifol", component: portifol },
      { path: "/editportifolos/:id", name: "editportifolos", component: editportifolos },
      { path: "/teamindex", name: "teamindex", component: teamindex },
      { path: "/teampost", name: "teampost", component: teampost },
      { path: "/teamsedit/:id", name: "teamsedit", component: teamsedit },
      { path: "/clientindex", name: "clientindex", component: clientindex },
      { path: "/clientpost", name: "clientpost", component: clientpost },
      { path: "/clientedit/:id", name: "clientedit", component: clientedit },
    ],
    meta: { requiresAuth: true },
    beforeEnter: (to, from, next) => {
      if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (Auth.check()) {
          next();
        } else {
          next("/login");
        }
      } else {
        next();
      }
    },
  },

  // Front routes
  {
    path: "/home",
    name: "frontPage",
    component: frontPage,
    children: [
      { path: "/", name: "mainPage", component: mainPage },
      { path: "/about", name: "about", component: about },
      { path: "/blog/:id", name: "BlogDetail", component: BlogDetail, props: true, },
      { path: "/contact", name: "contact", component: contact },
      { path: "/portfront", name: "portfront", component: portfront },
      { path: "/portfront/:id", name: "portfolioDetail", component: portfolioDetail, props: true, },
      { path:"/servicefront",name:"servicefront",component:servicefront}, 
      { path:"/productfront",name:"productfront",component:productfront},

    ],
  },

  // Login routes
  { path: "/login", name: "login", component: login },
  { path: "/changePassword/:id", name: "changePassword", component: changePassword },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return { el: to.hash, behavior: "smooth" };
    }
    return savedPosition || { top: 0 };
  },
});

export default router;
