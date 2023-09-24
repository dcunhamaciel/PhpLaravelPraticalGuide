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
import NavComponent from './components/NavComponent.vue';
import MenuComponent from './components/MenuComponent.vue';

export default {
    components: {
        NavComponent, 
        MenuComponent
    }
}
</script>

<style>
    .bi {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    }

    /*
    * Sidebar
    */

    @media (min-width: 768px) {
    .sidebar .offcanvas-lg {
        position: -webkit-sticky;
        position: sticky;
        top: 48px;
    }
    .navbar-search {
        display: block;
    }
    }

    .sidebar .nav-link {
    font-size: .875rem;
    font-weight: 500;
    }

    .sidebar .nav-link.active {
    color: #2470dc;
    }

    .sidebar-heading {
    font-size: .75rem;
    }

    /*
    * Navbar
    */

    .navbar-brand {
    padding-top: .75rem;
    padding-bottom: .75rem;
    background-color: rgba(0, 0, 0, .25);
    box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar .form-control {
    padding: .75rem 1rem;
    }
</style>
