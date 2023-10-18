<template>    
    <label class="btn btn-primary">
        Upload <input type="file" hidden @change="upload($event.target.files)">
    </label>
</template>

<script lang="ts">
import axios from 'axios'

export default {
    name: 'ImageUploadComponent',
    emits: ['uploaded'],    
    setup(props, context) {
        const upload = async (files: FileList | null) => {
            if (files === null) {
                return
            }

            const formData = new FormData
            formData.append('image', files[0])

            const { data } = await axios.post('upload', formData)

            context.emit('uploaded', data.url)
        }

        return {
            upload
        }
    }
}
</script>
