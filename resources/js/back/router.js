import { createRouter, createWebHashHistory } from "vue-router";
import Auth from "../login/auth";
import adminPage from "./back.vue";
import dashbord from "./index.vue";


//corrected routes

import Blogs from "./pages/Blogs/index.vue";
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

import companypost from "./pages/company/create.vue";
import companyindex from "./pages/company/index.vue";
import companyedit from "./pages/company/edit.vue";



import editevent from "./pages/events/edit.vue";
import content from "./pages/content/webcontent/index.vue";
import editweb from "./pages/content/webcontent/edit.vue";
import editdepartment from "./pages/content/departmentconntent/edit.vue";
import ourwork from "./pages/ourworks/index.vue";
import postwork from "./pages/ourworks/create.vue";
import editwork from "./pages/ourworks/edit.vue";
import services from "./pages/service/index.vue";
import editservice from "./pages/service/edit.vue";
import answer from "./pages/question/answer.vue";
import channels from "./pages/channels/index.vue";
import createResource from "./pages/channels/create.vue";
import brodcast from "./pages/channels/brodcaster/brodcast.vue";
import eventannauncer from "./pages/events/create.vue";
import profile from "./pages/profiles/index.vue";
import userprofile from "./pages/profiles/profiles.vue";
import comingsoon from "../errors/comingsoon.vue";


import testimonial from "./pages/testimonies/create.vue";
import newtestimonial from "./pages/testimonies/index.vue";


//front routes
import frontPage from "../front/frontPage.vue"
import mainPage from "../front/index.vue";
import contact from "../front/contact/index.vue";
import resource from "../front/resource/index.vue";
import Aboutekocha from "../front/aboutKocha/index.vue";
import aboutdeps from "../front/departments/departmenthead/index.vue";
import expansion from "../front/departments/expansion/index.vue";
import development from "../front/departments/development/index.vue";
import minirals from "../front/departments/minirals/index.vue";
import news from "../front/news/index.vue";
import getnewsDetail from "../front/news/newsDetail/index.vue";
import geteventDetail from "../front/news/eventDetail/index";
import getourwork from "../front/ourwork/index.vue";

import login from "../login/loginPage.vue";
import chengepassword from "../login/changeePassword.vue"



const routes = [
    {
        path: "/adminPage",
        name: "adminPage",
        component: adminPage,
        children: [
            {
                path: "/dashbord",
                name: "dashbord",
                component: dashbord,
            },
            {
                path: "/post",
                name: "post",
                component: post,
            },
            {
                path: "/edit/:id",
                name: "edit",
                component: edit,
            },
            {
                path: "/editevent/:id",
                name: "editevent",
                component: editevent,
            },

            // corrected route
            {
                path: "/Blogs",
                name: "Blogs",
                component: Blogs,
            },
            {
                path: "/portifolos",
                name: "portifolos",
                component: portifolos,
            },
            {
                path: "/portifol",
                name: "portifol",
                component: portifol,
            },
            {
                path: "/editportifolos/:id",
                name: "editportifolos",
                component: editportifolos,
            },
            {
                path: "/teamindex",
                name: "teamindex",
                component: teamindex,
            },
            {
                path: "/teampost",
                name: "teampost",
                component: teampost,
            },
            {
                path: "/teamsedit/:id",
                name: "teamsedit",
                component: teamsedit,
            },
            {
                path: "/clientindex",
                name: "clientindex",
                component: clientindex,
            },
            {
                path: "/clientpost",
                name: "clientpost",
                component: clientpost,
            },
            {
                path: "/clientedit/:id",
                name: "clientedit",
                component: clientedit,
            },
            {
                path: "/companyindex",
                name: "companyindex",
                component: companyindex,
            },
            {
                path: "/companypost",
                name: "companypost",
                component: companypost,
            },
            {
                path: "/companyedit/:id",
                name: "companyedit",
                component: companyedit,
            },
            




            {
                path: "/content",
                name: "content",
                component: content,
            },
            {
                path: "/ourwork",
                name: "ourwork",
                component: ourwork,
            },
            {
                path: "/postwork",
                name: "postwork",
                component: postwork,
            },
            {
                path: "/editwork/:id",
                name: "editwork",
                component: editwork,
            },
            {
                path: "/editweb/:id",
                name: "editweb",
                component: editweb,
            },
            {
                path: "/editdepartment/:id",
                name: "editdepartment",
                component: editdepartment,
            },
            {
                path: "/services",
                name: "services",
                component: services,
            },
            {
                path: "/editservice/:id",
                name: "editservice",
                component: editservice,
            },
            {
                path: "/answer/:id",
                name: "answer",
                component: answer,
            },
            {
                path: "/channels",
                name: "channels",
                component: channels,
            },
            {
                path: "/createResource",
                name: "createResource",
                component: createResource,
            },
            {
                path: "/brodcast",
                name: "brodcast",
                component: brodcast,
            },
            {
                path: "/eventannauncer",
                name: "eventannauncer",
                component: eventannauncer,
            },
            {
                path: "/profile",
                name: "profile",
                component: profile,
            },
            {
                path: "/userprofile",
                name: "userprofile",
                component: userprofile,
            },
            {
                path: "/comingsoon",
                name: "comingsoon",
                component: comingsoon,
            },
           
           
            {
                path: "/testimonial",
                name: "testimonial",
                component: testimonial,
            },

            {
                path: "/newtestimonial",
                name: "newtestimonial",
                component: newtestimonial,
            },
           
        ],
        meta: {
            requiresAuth: true,
        },
        beforeEnter: (to, from, next) => {
            if (to.matched.some((record) => record.meta.requiresAuth)) {
                console.log(Auth.check());
                if (Auth.check()) {
                    next();
                    return;
                } else {
                    next("/login");
                }
            } else {
                next();
            }
        },
    },

    // front routes

    {
        path: "/home",
        name: "frontPage",
        component: frontPage,
        children: [
            {
                path: "/",
                name: "mainPage",
                component: mainPage,
            },
            {
                path: "/contact",
                name: "contact",
                component: contact,
            },
            {
                path: "/resource",
                name: "resource",
                component: resource,
            },
            {
                path: "/Aboutekocha",
                name: "Aboutekocha",
                component: Aboutekocha,
            },
            {
                path: "/aboutdeps",
                name: "aboutdeps",
                component: aboutdeps,
            },
            {
                path: "/news",
                name: "news",
                component: news,
            },
            {
                path: "/getnewsDetail/:id",
                name: "getnewsDetail",
                component: getnewsDetail,
            },
            {
                path: "/geteventDetail/:id",
                name: "geteventDetail",
                component: geteventDetail,
            },
            {
                path: "/expansion",
                name: "expansion",
                component: expansion,
            },
            {
                path: "/development",
                name: "development",
                component: development,
            },
            {
                path: "/minirals",
                name: "minirals",
                component: minirals,
            },
            {
                path: "/getourwork",
                name: "getourwork",
                component: getourwork,
            },
        ],
    },

    //logins

    {
        path: "/login",
        name: "login",
        component: login,
    },
    {
        path: "/chengepassword/:id",
        name: "chengepassword",
        component: chengepassword,
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
