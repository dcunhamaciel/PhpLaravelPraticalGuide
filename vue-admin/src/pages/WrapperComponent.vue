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

export default {
    components: {
        NavComponent, 
        MenuComponent
    }
}
</script>
