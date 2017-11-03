require('./bootstrap');
window.Vue = require('vue');

Vue.component('example', require('./components/Example.vue'));
Vue.component('sign-up', require('./components/SignUp.vue'));

const app = new Vue({
    el: '#app',
});