import Vue from "vue";
import Vuetify from 'vuetify';

require('./bootstrap');

window.Vue = require('vue').default;

Vue.use(Vuetify);


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify()
});
