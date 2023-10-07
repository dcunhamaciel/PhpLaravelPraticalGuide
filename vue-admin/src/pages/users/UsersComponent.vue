<template>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.first_name }} {{ user.last_name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role.name }}</td>
                <td></td>
            </tr>
        </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" @click="prev">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" @click="next">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
import { onMounted, ref, watch } from 'vue';
import axios from 'axios';

export default {
    name: 'UsersComponent',
    setup() {
        const users = ref([])
        const page = ref(1)
        const lastPage = ref(1)

        const load = async () => {
            const { data } = await axios.get(`users?page=${page.value}`)

            users.value = data.data
            lastPage.value = data.meta.last_page
        }

        onMounted(load)

        watch(page, load)

        const prev = () => {
            if (page.value > 1) {
                page.value--
            }
        }

        const next = () => {
            if (page.value < lastPage.value) {
                page.value++
            }
        }

        return {
            users,
            prev,
            next
        }
    }
}
</script>
