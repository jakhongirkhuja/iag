import Home from './views/Home';
import Olx from './views/Olx';
import Uybor from './views/Uybor';
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
]