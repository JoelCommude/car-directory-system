import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Dashboard from './components/dashboard'
import Login from './base/Login'

export default new VueRouter({
    mode:'history',
    routes:[
        // {
        //     path:'/login',
        //     name:'login',
        //     component:Login
        // },
        {
            path:'/home',
            name:'home',
            component:Dashboard
        },
    ]
})