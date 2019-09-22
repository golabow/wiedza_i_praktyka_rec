
import jquery from 'jquery';
window.$ = window.jQuery = jquery;
import './app.css';
import 'bootstrap';
import Vue from 'vue';

import user_form from './component/user_form.vue';
Vue.component('user-form', user_form);
import user_list from './component/user_list.vue';
Vue.component('user-list', user_list);

var app = new Vue({
    //delimiters: ['${', '}'],
    el: '#app',
    data: {}
});