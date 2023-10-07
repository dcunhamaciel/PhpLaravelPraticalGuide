<template>
    <form @submit.prevent="submit">
        <div class="mb-3">
            <label>Name</label>
            <input v-model="data.name" class="form-control" name="first_name">
        </div>
        <div class="mb-3">
            <label>Permissions</label>
            <div class="col-sm-10">
                <div v-for="permission of permissionsList" :key="permission.id" class="form-check form-check-inline col-3">
                    <input class="form-check-input" type="checkbox" :value="permission.id" :checked="checked(permission.id)" @change="select(permission.id, $event.target.checked)"> 
                    <label class="form-check-label">{{ permission.name }}</label>
                </div>                
            </div>
        </div>
        <button class="btn btn-outline-secondary">Save</button> 
    </form>    
</template>

<script lang='ts'>
import { reactive, ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios'
import { Permission } from '../../models/permission'

export default {
    name: 'RoleEditComponent',
    setup() {
        const data = reactive({
            name: '',
            permissions: [] as number[]
        })

        const permissionsList = ref([])
        
        const route = useRoute()
        const router = useRouter()

        onMounted(async () => {
            const response = await axios.get(`roles/${route.params.id}`)

            const permissionsResponse = await axios.get('permissions')

            data.name = response.data.name
            data.permissions = response.data.permissions.map((permission: Permission) => permission.id)

            permissionsList.value = permissionsResponse.data
        })

        const select = (id: number, checked: boolean) => {
            if (checked) {                
                data.permissions.push(id)
                return
            }

            data.permissions = data.permissions.filter(permission => permission !== id)
        }

        const checked = (id: number) => {
            return data.permissions.some(permission => permission === id)
        }

        const submit = async () => {
            await axios.put(`roles/${route.params.id}`, data)

            await router.push('/roles')
        }

        return {
            data,
            permissionsList,
            select,
            checked,
            submit
        }   
    }
}
</script>
