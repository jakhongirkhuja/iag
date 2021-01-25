
export const routes = [
    {
        path: '/',
        name: 'main',
        component: () => import(/* webpackChunkName: "main" */ './views/Main')
    },
    {
        path: '/dash',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ './views/Home')
    },
    {
        path: '/estate/:slug',
        name: 'estate',
        component: ()=>import(/* webpackChunkName: "Estate" */ './views/Estate')    
    },
    {
        path: '/owners',
        name: 'owners',
        component: ()=>import(/* webpackChunkName: "Owner" */ './views/Owners'),
    },
    {
        path: '/owners/:id',
        name: 'OwnersEach',
        component: ()=>import(/* webpackChunkName: "OwnerEach" */ './views/OwnersEach'),
    },
]