/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import { createApp } from 'vue';
import adminRouter from './routes/admin';
import clientRouter from './routes/admin';

import adminHome from './views/admin/Home.vue';
import clientHome from './views/admin/Home.vue';

// Load root component respectively to user privileges
const app = createApp(PHP_USER.is_admin ? adminHome : clientHome, PHP_USER);

// Load route respectively to user privileges
app.use(PHP_USER.is_admin ? adminRouter : clientRouter);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Mount the app into browser DOM
app.mount('#app');

// document.getElementById('app').innerText = JSON.stringify(PHP_USER);