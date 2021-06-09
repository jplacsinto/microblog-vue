import Home from './components/views/Home.vue';
import Profile from './components/views/Profile.vue';
import Settings from './components/views/Settings.vue';
import Login from './components/views/Login.vue';
import Register from './components/views/Register.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'profile',
        path: '/profile',
        component: Profile
    },
    {
        name: 'settings',
        path: '/settings',
        component: Settings
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    }
];