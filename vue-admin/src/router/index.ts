import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import DashboardComponent from '../pages/DashboardComponent.vue'
import UsersComponent from '../pages/UsersComponent.vue'
import RegisterComponent from '../pages/RegisterComponent.vue'

const routes: Array<RouteRecordRaw> = [
    { path: '', component: DashboardComponent },
    { path: '/users', component: UsersComponent },
    { path: '/register', component: RegisterComponent },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
