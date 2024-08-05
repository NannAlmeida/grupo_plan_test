import Vue from 'vue';
import App from './App.vue';
import router from './router';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import { BootstrapVue } from 'bootstrap-vue';

// createApp(App).use(BootstrapVue).mount('#app');

Vue.use(BootstrapVue);

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');