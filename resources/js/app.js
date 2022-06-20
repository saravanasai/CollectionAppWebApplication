require("./bootstrap");
import { createApp } from "vue";
import App from "./src/index.vue";
import router from "./src/routes/routes";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


import store from "./store";
const app = createApp(App);
app.provide("store", store());
app.use(VueToast,{
    // One of the options
    position: 'top'
});
app.use(VueSweetalert2);
app.use(router);
window.Swal = app.config.globalProperties.$swal;
window.Toast = app.config.globalProperties.$toast;


// app.component('home-component',require('./components/Test/Test.vue').default)
app.mount("#app");
