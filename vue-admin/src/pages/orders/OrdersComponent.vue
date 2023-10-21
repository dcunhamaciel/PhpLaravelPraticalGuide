<template>
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <router-link to="/orders/create" class="btn btn-sm btn-outline-secondary">Add</router-link>
    </div>
    <div class="table-responsive small">
        <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="order in orders" :key="order.id">
                <tr>
                    <td>{{ order.id }}</td>
                    <td>{{ order.name }}</td>
                    <td>{{ order.email }}</td>
                    <td>{{ order.total }}</td>
                    <td>
                        <div class="btn-group mr-2">
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary">View</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <div>
                            <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Title</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in order.order_items" :key="item.id">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.product_title }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <td>{{ item.price }}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </template>
        </tbody>
        </table>
    </div>

    <PaginatorComponent :lastPage="lastPage" @page-changed="loadOrders($event)"/>
</template>

<script lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';
import PaginatorComponent from '../../components/PaginatorComponent.vue';

export default {
    name: 'OrdersComponent',
    components: { PaginatorComponent },
    setup() {
        const orders = ref([])
        const lastPage = ref(1)

        const loadOrders = async (page = 1) => {
            const { data } = await axios.get(`orders?page=${page}`)

            orders.value = data.data
            lastPage.value = data.meta.last_page            
        }

        onMounted(loadOrders)

        return {
            orders,
            lastPage,
            loadOrders            
        }
    }    
}
</script>
