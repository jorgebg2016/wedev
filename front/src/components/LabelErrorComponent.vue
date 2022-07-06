<template>
    <label class="error d-flex align-items-center text-danger" v-if="error && (name in errors)">
        <alert-circle-icon size="1.0x" class="custom-class mr-2"></alert-circle-icon>
        {{ errors[name][0] }}
    </label>
</template>

<style scoped>
    label.error {
        padding: 3px;
        margin-top: 3px;
        margin-bottom: 3px;
    }
</style>

<script>
    import { AlertCircleIcon } from 'vue-feather-icons'
    export default {
        name: 'LabelErrorComponent',
        components: {
            AlertCircleIcon
        },
        props: {
            error: null,
            errors: [],
            name: null
        }
    }
</script>