import { createWebHistory, createRouter } from "vue-router";
import Home from '../views/client/Home.vue';
import Notifications from '../views/client/Notifications.vue';
import Tournaments from '../views/client/Tournaments.vue';
import Profile from '../views/client/Profile.vue';

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
  },
  {
    path: '/notificacoes',
    name: 'notifications',
    component: Notifications,
  },
  {
    path: '/torneios',
    name: 'tournaments',
    component: Tournaments,
  },
  {
    path: '/perfil',
    name: 'profile',
    component: Profile,
  },
];

const router = createRouter({
  history: createWebHistory('/plataforma'),
  routes,
});

export default router;