import Home from './views/Home';
import Estate from './views/Estate';
import Owners from './views/Owners';
import OwnersEach from './views/OwnersEach';
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
    },
    {
        path: '/owners',
        name: 'owners',
        component: Owners
    },
    {
        path: '/owners/:id',
        name: 'OwnersEach',
        component: OwnersEach
    },
]