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
                    <input class="form-check-input" type="checkbox" :value="permission.id" @change="select(permission.id, $event.target.checked)"> 
                    <label class="form-check-label">{{ permission.name }}</label>
                </div>                
            </div>
        </div>
        <button class="btn btn-outline-secondary">Save</button> 
    </form>    
</template>

<script lang='ts'>
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios'

export default {
    name: 'RoleCreateComponent',
    setup() {
        const data = reactive({
            name: '',
            permissions: []
        })

        const permissionsList = ref([])
        
        const router = useRouter()

        onMounted(async () => {
            const permissionsResponse = await axios.get('permissions')

            permissionsList.value = permissionsResponse.data
        })

        const select = (id: never, checked: boolean) => {
            if (checked) {                
                data.permissions.push(id)
                return
            }

            data.permissions = data.permissions.filter(permission => permission !== id)
        }

        const submit = async () => {
            await axios.post('roles', data)

            await router.push('/roles')
        }

        return {
            data,
            permissionsList,
            select,
            submit
        }   
    }
}
</script>
