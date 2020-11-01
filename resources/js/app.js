/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.min.css";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

import VueClipboard from "vue-clipboard2";
import CKEditor from "@ckeditor/ckeditor5-vue";

Vue.use(CKEditor);
Vue.use(VueSweetalert2);
Vue.use(Loading);
Vue.use(VueClipboard);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component("v-auth", {
  name: "v-auth",
  template: `<span></span>`,
  props: ["auth"],
  methods: {
    saveAuth() {
      this.$emit("saved", this.auth);
    }
  },
  mounted() {
    this.saveAuth();
  }
});

Vue.component("multi-select", Multiselect);

Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue").default
);
Vue.component("v-table", require("./components/Table.vue").default);
Vue.component("v-button", require("./components/Button.vue").default);
Vue.component("v-info-button", require("./components/InfoButton.vue").default);
Vue.component("v-interview", require("./components/Interview.vue").default);
Vue.component("v-search-form", require("./components/SearchForm.vue").default);
Vue.component("v-track", require("./components/Track.vue").default);
Vue.component(
  "v-user-create-form",
  require("./components/UserCreateForm.vue").default
);
Vue.component(
  "v-template-add-more-input",
  require("./components/AddMoreInput.vue").default
);
Vue.component(
  "v-template-add-more-input-edit",
  require("./components/AddMoreInputEdit.vue").default
);
Vue.component("v-payment", require("./components/Payment.vue").default);
Vue.component(
  "v-document-editor",
  require("./components/DocumentEditor.vue").default
);
Vue.component(
  "v-copy-clipboard-btn",
  require("./components/CopyToClipboard.vue").default
);

Vue.component(
  "v-certificate-file-upload",
  require("./components/CertificateFileUpload.vue").default
);

Vue.component(
  "v-bop-sessions-date-time-picker",
  require("./components/BOPSessions/DateTimePicker.vue").default
);

Vue.component(
  "v-bop-sessions-button",
  require("./components/BOPSessions/Button.vue").default
);

Vue.prototype.$location = window.location;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app",
  data() {
    return {
      auth_user: ""
    };
  },
  methods: {
    isDatePast(date) {
      let [day, month, year] = date.split("-");
      let dateObj = new Date(`${year}-${month}-${day}`);
      return dateObj < new Date();
    },
    auth(value) {
      this.auth_user = value;
    }
  }
});
