import Vue from 'vue';
import Router from 'vue-router';
import Login from './components/Login.vue';
import Dashboard from './components/Dashboard.vue';


Vue.use(Router);

const isAuthenticated = () => !!localStorage.getItem('authToken');

const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
        beforeEnter: (to, from, next) => {
            // caso não esteja logado
            !isAuthenticated() ? next() : next({ name: 'dashboard' });
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            // caso não esteja logado
            isAuthenticated() ? next() : next({ name: 'login' });
        }
    }
];

export default new Router({
    mode: 'history',
    routes
});