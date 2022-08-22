window.Vue = require('vue');
import { createRouter, createWebHistory } from "vue-router";
import productIndex from '../components/products/index.vue';
import notFound from '../components/notFound.vue';


//Vue.prototype.$site_url = "http://localhost/vueapp/";
const routes = [
    {
        path:'/vueapp/',
        component: productIndex
    },
    {
        path:'/vueapp/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
})
export default router