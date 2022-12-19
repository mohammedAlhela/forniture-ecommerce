import Vue from "vue";
import VueRouter from "vue-router";

// // admins routes
// import adminsDashboard from "../pages/admins/dashboard/dashboard.vue";
// import adminsCategories from "../pages/admins/categories/categories.vue";
// import adminsOptions from "../pages/admins/options/options.vue";
// import adminsProducts from "../pages/admins/products/products.vue";
// // admins routes



Vue.use(VueRouter);
const routes = [
  
    // {
    //     path: "/admins/dashboard",
    //     name: "admins-dashboard",
    //     component: adminsDashboard,
    // },


    // {
    //     path: "/admins/categories",
    //     name: "admins-categories",
    //     component: adminsCategories,
    // },

    // {
    //     path: "/admins/options",
    //     name: "admins-options",
    //     component: adminsOptions,
    // },

    // {
    //     path: "/admins/products",
    //     name: "admins-products",
    //     component: adminsProducts,
    // },
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
});

export default router;
