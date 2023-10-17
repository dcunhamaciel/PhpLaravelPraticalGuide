<template>
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

<script lang="ts">
import { ref, watch, defineComponent } from 'vue';

export default defineComponent({
    name: 'PaginatorComponent',
    emits: ['page-changed'],
    props: {
        lastPage: Number
    },
    setup(props, context) {
        const page = ref(1)

        watch(page, () => {
            context.emit('page-changed', page.value)
        })

        const prev = () => {
            if (page.value > 1) {
                page.value--
            }
        }

        const next = () => {
            if (props.lastPage) {
                if (page.value < props.lastPage) {
                    page.value++
                }         
            }
        }

        return {
            prev,
            next
        }
    }
})
</script>