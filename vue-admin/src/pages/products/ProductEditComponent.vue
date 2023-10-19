<template>
    <form @submit.prevent="submit">
        <div class="mb-3">
            <label>Title</label>
            <input v-model="data.title" class="form-control" name="title">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea v-model="data.description" class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <div class="input-group">
                <input v-model="data.image" class="form-control" name="image">
                <ImageUploadComponent @uploaded="data.image = $event"/>
            </div>            
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input v-model="data.price" type="number" class="form-control" name="price">
        </div>  
        <button class="btn btn-outline-secondary">Save</button> 
    </form>
</template>

<script lang='ts'>
import { reactive, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios'
import ImageUploadComponent from '@/components/ImageUploadComponent.vue';

export default {
    name: 'ProductEditComponent',
    components:  { ImageUploadComponent },
    setup() {
        const data = reactive({
            title: '',
            description: '',
            image: '',
            price: ''
        })

        const route = useRoute()
        const router = useRouter()

        onMounted(async () => {
            const response = await axios.get(`products/${route.params.id}`)
            
            data.title = response.data.title
            data.description = response.data.description
            data.image = response.data.image
            data.price = response.data.price
        })

        const submit = async () => {
            await axios.put(`products/${route.params.id}`, data)

            await router.push('/products')
        }

        return {
            data,
            submit
        }
    }        
}
</script>
