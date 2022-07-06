<template>
    <div id="edit-products" class="row">
        <EditProductsComponent />
    </div>
</template>

<style scoped>
    #edit-products {
        padding: 0px;
        margin: 0px;
    }
</style>

<script>
    import EditProductsComponent from '@/components/Products/EditProductsComponent.vue'
    export default {
        name: 'EditProductsView',
        components: {
            EditProductsComponent,
        }
    }
</script>