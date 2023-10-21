<template>
    <NavComponent/>

    <div class="container-fluid">
    <div class="row">
        <MenuComponent/>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <router-view/>
        </main>
    </div>
    </div>
</template>

<script>
import NavComponent from '../components/NavComponent.vue';
import MenuComponent from '../components/MenuComponent.vue';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import axios from 'axios';

export default {
    name: 'WrapperComponent',
    components: {
        NavComponent, 
        MenuComponent
    },
    setup() {
        const router = useRouter()
        const store = useStore()

        onMounted(async () => {
            try {
                const { data } = await axios.get('user')

                await store.dispatch('User/setUser', data)
            } catch (e) {
                await router.push('/login')
            }
        })
    }
}
</script>
