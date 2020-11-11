import Home from './views/Home';

import Estate from './views/Estate';
export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/estate/:slug',
        name: 'estate',
        component: Estate
     }
]