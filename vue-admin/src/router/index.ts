import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import RegisterComponent from '../pages/RegisterComponent.vue'
import LoginComponent from '../pages/LoginComponent.vue'
import WrapperComponent from '../pages/WrapperComponent.vue'
import DashboardComponent from '../pages/DashboardComponent.vue'
import UsersComponent from '../pages/users/UsersComponent.vue'
import UserCreateComponent from '../pages/users/UserCreateComponent.vue'
import UserEditComponent from '../pages/users/UserEditComponent.vue'
import RolesComponent from '../pages/roles/RolesComponent.vue'
import RoleCreateComponent from '../pages/roles/RoleCreateComponent.vue'
import RoleEditComponent from '../pages/roles/RoleEditComponent.vue'
import ProductsComponent from '../pages/products/ProductsComponent.vue'
import ProductCreateComponent from '../pages/products/ProductCreateComponent.vue'

const routes: Array<RouteRecordRaw> = [
    { path: '/register', component: RegisterComponent },
    { path: '/login', component: LoginComponent },
    { 
        path: '', 
        component: WrapperComponent,
        children: [
            { path: '', component: DashboardComponent },
            { path: '/users', component: UsersComponent },
            { path: '/users/create', component: UserCreateComponent },
            { path: '/users/:id/edit', component: UserEditComponent },
            { path: '/roles', component: RolesComponent },
            { path: '/roles/create', component: RoleCreateComponent },
            { path: '/roles/:id/edit', component: RoleEditComponent },
            { path: '/products', component: ProductsComponent },
            { path: '/products/create', component: ProductCreateComponent },
        ] 
    },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
