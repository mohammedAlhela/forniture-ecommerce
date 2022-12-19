/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

Vue.prototype.$authenticatedUser = window.User;

Vue.prototype.$token = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

import Swal from "sweetalert2";
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

window.Toast = Toast;

import Vue from "vue";
import Vuetify from "vuetify";
import store from "./store/index";
import router from "./router";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component(
    "loader-component",
    require("./components/include/loader.vue").default
);

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component(
    "account-component",
    require("./pages/account.vue").default
);

Vue.component(
    "home-component",
    require("./pages/home.vue").default
);

Vue.component(
    "reports-component",
    require("./pages/reports.vue").default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuetify);

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    store,
    router,
});
