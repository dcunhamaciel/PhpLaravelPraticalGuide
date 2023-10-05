<template>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>

        <nav class="my-2 my-md-0 mr-md-3">
            <router-link to="/profile" class="p-2 text-white text-decoration-none" href="#">{{ name }}</router-link>
            <router-link to="/login" class="p-2 text-white text-decoration-none" @click="logout">Sign out</router-link>
        </nav>
    </nav>
</template>

<script lang="ts">
import { ref } from 'vue';
import { onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'NavComponent',
    setup() {
        const name = ref('')

        onMounted(async () => {
            name.value = ''

            try {
                const { data } = await axios.get('user')

                name.value = data.first_name + ' ' + data.last_name

            } catch (error) {                
                console.log(error)
            }            
        })

        const logout = async () => {
            await axios.post('logout')
        }

        return {
            name,
            logout
        }
    }
}
</script>