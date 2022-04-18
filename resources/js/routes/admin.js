import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/admin/Home.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: '/torneios',
    name: 'tournaments',
    component: Home,
  },
  {
    path: '/perfil',
    name: 'profile',
    component: Home,
  },
  {
    path: '/notificacoes',
    name: 'notifications',
    component: Home,
  },
  {
    path: '/pagamentos',
    name: 'payments',
    component: Home,
  },
  {
    path: '/anuncios',
    name: 'ads',
    component: Home,
  },
  {
    path: '/configuracoes',
    name: 'settings',
    component: Home,
  }
];

const router = createRouter({
  history: createWebHistory('/plataforma'),
  routes,
});

export default router;