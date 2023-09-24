import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import RegisterComponent from '../pages/RegisterComponent.vue'
import WrapperComponent from '../pages/WrapperComponent.vue'
import DashboardComponent from '../pages/DashboardComponent.vue'
import UsersComponent from '../pages/UsersComponent.vue'

const routes: Array<RouteRecordRaw> = [
    { path: '/register', component: RegisterComponent },
    { 
        path: '', 
        component: WrapperComponent,
        children: [
            { path: '', component: DashboardComponent },
            { path: '/users', component: UsersComponent },
        ] 
    },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
