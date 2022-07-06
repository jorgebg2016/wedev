<template>
    <div id="create-customers" class="row">
        <CreateProductsComponent />
    </div>
</template>

<style scoped>
    #create-customers {
        padding: 0px;
        margin: 0px;
    }
</style>

<script>
    import CreateProductsComponent from '@/components/Products/CreateProductsComponent.vue'
    export default {
        name: 'CreateProductsView',
        components: {
            CreateProductsComponent,
        }
    }
</script>