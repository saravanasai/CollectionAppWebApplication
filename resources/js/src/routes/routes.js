import { createRouter, createWebHistory } from "vue-router";

import Home from "../Page/Home/Home.vue";
import Register from "../Page/Register/Register.vue";
import Login from "../Page/Login/Login.vue";
import About from "../Page/About/About.vue";
import NotFound from "../Page/404/404.vue";
import Dashboard from "../Page/Dashboard/Dashboard.vue";
import Customer from "../Page/Customer/Customer.vue";
import AddCustomer from "../Page/Customer/AddCustomer.vue";
import EditCustomer from "../Page/Customer/EditCustomer.vue";
import SingleCustomerTransaction from "../Page/Transaction/SingleCustomerTransaction.vue";

import Pay from "../Page/Pay/Pay.vue";
import Plan from "../Page/Plan/Plan.vue";
import Location from "../Page/Location/Location.vue";
import EditLocation from "../Page/Location/EditLocation.vue";
import Agent from "../Page/Agent/Agent.vue";
import EditAgent from "../Page/Agent/EditAgent.vue";
import Scheme from "../Page/Scheme/Scheme.vue";
import AdvanceFilter from "../Page/AdvanceFilter/AdvanceFilter.vue";
import OpenSearch from "../Page/OpenSearch/OpenSearch.vue";
import TransactionReport from "../Page/TransactionReport/TransactionReport.vue";

const routes = [
    {
        path: "/reports",
        name: "reports",
        component: TransactionReport,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/search/open-search",
        name: "open-search",
        component: OpenSearch,
        meta: { requiresAuth: false },
    },
    {
        path: "/advance-filter",
        name: "advance-filter",
        component: AdvanceFilter,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/all-schemes",
        name: "scheme",
        component: Scheme,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/agent/:id/edit",
        name: "agent-edit",
        component: EditAgent,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/all-agents",
        name: "agents",
        component: Agent,
        props: true,
        meta: { requiresAuth: true },
    },

    {
        path: "/location/:id/edit",
        name: "edit-location",
        component: EditLocation,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/location",
        name: "location",
        component: Location,
        props: false,
        meta: { requiresAuth: true },
    },
    {
        path: "/plan",
        name: "plan",
        component: Plan,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/customer/:id/pay",
        name: "customer-pay",
        component: Pay,
        props: true,
        meta: { requiresAuth: true },
    },
    {
        path: "/customer/:id/transaction",
        name: "customer-transaction",
        component: SingleCustomerTransaction,
        props: true,
        meta: { requiresAuth: false },
    },


    {
        path: "/customer/:id/edit",
        name: "customer-edit",
        component: EditCustomer,
        props: true,
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
