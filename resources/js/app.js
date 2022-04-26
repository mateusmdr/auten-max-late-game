/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';
import adminRouter from './routes/admin';
import clientRouter from './routes/client';

import App from './views/App.vue';


// Load root component respectively to user privileges
const app = createApp(App);

PHP_USER.is_admin = false;

// Provide user info to globally
app.config.globalProperties.user = PHP_USER;

// Load route respectively to user privileges
app.use(PHP_USER.is_admin ? adminRouter : clientRouter);

//Load modals plugin
import { vfmPlugin } from 'vue-final-modal'

app.use(vfmPlugin);

app.mount('#app');