import Home from './views/Home';
import Olx from './views/Olx';
import Uybor from './views/Uybor';
import Estate from './views/Estate';
export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/olx',
        name: 'olx',
        component: Olx
    },
    {
        path: '/uybor',
        name: 'uybor',
        component: Uybor
    },
    {
        path: '/estate/:slug',
        name: 'estate',
        component: Estate
     }
]