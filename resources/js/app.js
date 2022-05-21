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
// Include global functions
import {func} from './func.js'

app.config.globalProperties.$func = func

// Load route respectively to user privileges
app.use(PHP_USER.is_admin ? adminRouter : clientRouter);

//Register global components
const globalComponents = require.context('./views/components', false, /\.vue$/i)
globalComponents.keys().map(key => app.component(key.split('/').pop().split('.')[0], globalComponents(key).default))

//Register specific components
const adminComponents = require.context('./views/components/admin', true, /\.vue$/i)
adminComponents.keys().map(key => app.component('Admin' + key.split('/').pop().split('.')[0], adminComponents(key).default))

const clientComponents = require.context('./views/components/client', true, /\.vue$/i)
clientComponents.keys().map(key => app.component('Client' + key.split('/').pop().split('.')[0], clientComponents(key).default))

//Load pinia root store
import { createPinia } from 'pinia'

app.use(createPinia());

//Load modals plugin
import { vfmPlugin } from 'vue-final-modal'

app.use(vfmPlugin);

app.mount('#app');