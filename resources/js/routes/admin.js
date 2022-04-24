import { createWebHistory, createRouter } from "vue-router";
import Home from "../views/admin/Home.vue";
import Tournaments from '../views/admin/Tournaments.vue';
import Users from '../views/admin/Users.vue';
import Notifications from '../views/admin/Notifications.vue';
import Payments from '../views/admin/Payments.vue';
import Ads from '../views/admin/Ads.vue';
import Settings from '../views/admin/Settings.vue';

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: '/torneios',
    name: 'tournaments',
    component: Tournaments,
  },
  {
    path: '/usuarios',
    name: 'users',
    component: Users,
  },
  {
    path: '/notificacoes',
    name: 'notifications',
    component: Notifications,
  },
  {
    path: '/pagamentos',
    name: 'payments',
    component: Payments,
  },
  {
    path: '/anuncios',
    name: 'ads',
    component: Ads,
  },
  {
    path: '/configuracoes',
    name: 'settings',
    component: Settings,
  }
];

const router = createRouter({
  history: createWebHistory('/plataforma'),
  routes,
});

export default router;