import Vue from 'vue'
import App from './App.vue'
import router from './router'
import bootstrap from 'bootstrap'
import { popper } from '@popperjs/core'
import { BootstrapVue, IconsPlugin,BTable, BButton, BFormInput, BFormSelect, BFormCheckbox, BPagination, BFormGroup, BFormRadio, BFormTextarea } from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "./assets/main.css";



Vue.component('b-table', BTable);
Vue.component('b-button', BButton);
Vue.component('b-form-input', BFormInput);
Vue.component('b-form-select', BFormSelect);
Vue.component('b-checkbox', BFormCheckbox);
Vue.component('b-pagination', BPagination);
Vue.component('b-form-group', BFormGroup);
Vue.component('b-form-radio', BFormRadio);
Vue.component('b-form-checkbox',BFormCheckbox);
Vue.component('b-form-textarea',BFormTextarea);


new Vue({
  router,
  popper,
  BootstrapVue,
  IconsPlugin,
  bootstrap,
  render: (h) => h(App)
}).$mount('#app')