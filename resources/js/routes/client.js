import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/client/Home.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  // {
  //   path: "/about",
  //   name: "About",
  //   component: About,
  // },
];

const router = createRouter({
  history: createWebHistory('/home'),
  routes,
});

export default router;