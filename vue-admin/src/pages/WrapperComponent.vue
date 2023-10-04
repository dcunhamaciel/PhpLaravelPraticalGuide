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
import axios from 'axios';

export default {
    name: 'WrapperComponent',
    components: {
        NavComponent, 
        MenuComponent
    },
    setup() {
        onMounted(async () => {
            const data = await axios.get('user')
            console.log(data)
        })
    }
}
</script>
