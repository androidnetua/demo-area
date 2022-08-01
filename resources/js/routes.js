import store from "./store";

function checkPermissions(permission){
    let user = store.state.user
    if (user &&
        user.permissions.some(function (el){
            return el.name === permission
        })
    ) return

    return {name: 'home'}
}

export default [
    {
        path: '/',
        component: () => import('./components/Home'),
        name: 'home',
    },
    {
        path: '/users',
        component: () => import('./components/Users'),
        name: 'users',
        beforeEnter: () => {return checkPermissions('manage-users')},
    },
    {
        path: '/users/create',
        component: () => import('./components/UserCreate'),
        name: 'users.create',
        beforeEnter: () => {return checkPermissions('manage-users')},
    },
    {
        path: '/users/:id(\\d+)',
        component: () => import('./components/UserEdit'),
        name: 'users.edit',
        beforeEnter: () => {return checkPermissions('manage-users')},
    },
    {
        path: '/specs/cpu',
        component: () => import('./components/SpecsCpu'),
        name: 'specs.cpu',
        beforeEnter: () => {return checkPermissions('specs')},
    },
    {
        path: '/specs/gpu',
        component: () => import('./components/SpecsGpu'),
        name: 'specs.gpu',
        beforeEnter: () => {return checkPermissions('specs')},
    },
    {
        path: '/:path(.*)*',
        component: {
            mounted() {
                this.$router.push({name: 'home'})
            }
        },
        name: 'notfound',
    }
]
