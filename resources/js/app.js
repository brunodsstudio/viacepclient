
require('./bootstrap');
window.Vue = require('vue').default;

import VueMask from 'v-mask';
Vue.use(VueMask);

import JQuery from 'jquery'
window.$ = JQuery

/*import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";*/

import axios from "axios";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
