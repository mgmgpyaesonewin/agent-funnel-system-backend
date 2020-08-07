/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

axios.interceptors.response.use(response => {
  console.log(response);
  phpdebugbar.ajaxHandler.handle(response.request);
  return response;
});

window.Vue = require("vue");

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

Vue.use(Loading);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue").default
);
Vue.component("v-table", require("./components/Table.vue").default);
Vue.component("v-button", require("./components/Button.vue").default);
Vue.component("v-interview", require("./components/Interview.vue").default);
Vue.component("v-search-form", require("./components/SearchForm.vue").default);
Vue.component("v-track", require("./components/Track.vue").default);
Vue.component(
  "v-certification-table",
  require("./components/Certification/List.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app"
});
