<template>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td><img :src="product.image" width="50"></td>                
                <td>{{ product.title }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>
                    <div class="btn-group mr-2">
                        <router-link :to="`/products/${product.id}/edit`" class="btn btn-sm btn-outline-secondary">Edit</router-link>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary" @click="deleteProduct(product.id)">Delete</a>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
    </div>

    <PaginatorComponent :lastPage="lastPage" @page-changed="loadProducts($event)"/>
</template>

<script lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { Product } from '../../models/product';
import PaginatorComponent from '../../components/PaginatorComponent.vue';

export default {
    name: 'ProductsComponent',
    components: { PaginatorComponent },
    setup() {
        const products = ref([])
        const lastPage = ref(1)

        const loadProducts = async (page = 1) => {
            const { data } = await axios.get(`products?page=${page}`)

            products.value = data.data
            lastPage.value = data.meta.last_page            
        }

        const deleteProduct = async (id: number) => {
            if (confirm('Are you sure?')) {
                await axios.delete(`products/${id}`)

                products.value = products.value.filter((product: Product) => product.id !== id)
            }
        }

        onMounted(loadProducts)

        return {
            products,
            lastPage,
            loadProducts,
            deleteProduct
        }
    }
}
</script>
