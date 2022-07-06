<template>
    <div v-if="success" 
        class="success form-group bg-success row d-flex justify-content-center d-flex align-items-center">
        <bell-icon size="1.2x" class="custom-class mr-2"></bell-icon> {{ message }}
    </div>
</template>

<style scoped>
    div.success {
        border-radius: 3px;
        margin: 10px;
        margin-top: 20px;
        padding: 15px;
        color: white;
    }
</style>

<script>
    import { BellIcon } from 'vue-feather-icons'

    export default {
        name: 'NotificationComponent',
        props: {
            success: null,
            message: null
        },
        components: {
            BellIcon
        }
    }
</script>