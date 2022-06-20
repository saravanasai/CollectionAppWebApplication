import { createRouter, createWebHistory } from "vue-router";

import Home from "../Page/Home/Home.vue";
import Register from "../Page/Register/Register.vue";
import Login from "../Page/Login/Login.vue";
import About from "../Page/About/About.vue";
import NotFound from "../Page/404/404.vue";

const Dashboard = import("../Page/Dashboard/Dashboard.vue");
const Customer = import("../Page/Customer/Customer.vue");
const AddCustomer = import("../Page/Customer/AddCustomer.vue");
const EditCustomer = import("../Page/Customer/EditCustomer.vue");

const routes = [

    {
        path: "/customer/:id/edit",
        name: "customer-edit",
        component: EditCustomer,
        props:true,
        meta: { requiresAuth: true },
    },
    {
        path: "/all-customer",
        name: "all-customer",
        component: Customer,
        meta: { requiresAuth: true },
    },
    {
        path: "/new-customer",
        name: "new-customer",
        component: AddCustomer,
        meta: { requiresAuth: true },
    },
    {
        path: "/my-dashboard",
        name: "dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
    },
    {
        path: "/",
        name: "home",
        component: Home,
        meta: { requiresAuth: false },
    },
    {
        path: "/register-user",
        name: "register",
        component: Register,
    },
    {
        path: "/login-user",
        name: "login",
        component: Login,
    },
    {
        path: "/about-us",
        name: "about-us",
        component: About,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "404",
        component: NotFound,
    },
];
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from) => {
    if (to.meta.requiresAuth && !window.localStorage.getItem("auth_token")) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        return {
            name: "login",
            // save the location we were at to come back later
            query: { redirect: to.fullPath },
        };
    }

    // if (!isAuthenticated && to.name !== 'register') {
    //   return { name: 'register' }
    // }
});

export default router;
