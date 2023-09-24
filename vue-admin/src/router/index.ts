import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import DashboardComponent from '../pages/DashboardComponent.vue'
import UsersComponent from '../pages/UsersComponent.vue'

const routes: Array<RouteRecordRaw> = [
    { path: '', component: DashboardComponent },
    { path: '/users', component: UsersComponent }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
