<template>
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <router-link to="/roles/create" class="btn btn-sm btn-outline-secondary">Add</router-link>
    </div>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="role in roles" :key="role.id">
                <td>{{ role.id }}</td>
                <td>{{ role.name }}</td>
                <td>
                    <div class="btn-group mr-2">
                        <router-link :to="`/roles/${role.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</router-link>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary" @click="deleteRole(role.id)">Delete</a>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { Role } from '../../models/role';

export default {
    name: 'RolesComponent',
    setup() {
        const roles = ref([])

        const loadRoles = async () => {
            const { data } = await axios.get('roles')

            roles.value = data
        }

        const deleteRole = async (id: number) => {
            if (confirm('Are you sure?')) {
                await axios.delete(`roles/${id}`)

                roles.value = roles.value.filter((role: Role) => role.id !== id)
            }
        }

        onMounted(loadRoles)

        return {
            roles,
            deleteRole
        }
    }
}
</script>
