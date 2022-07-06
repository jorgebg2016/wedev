<template>
    <div class="update-products p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-2 col-sm-6 mt-2">
            <NotificationComponent :success="success" message="Product successfuly updated!"/>
            <form @submit="updateProduct">
                <FormProductsComponent :product="product" :errors="errors" :error="error" />
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/products" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-warning m-0" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import FormProductsComponent from './FormProductsComponent.vue'
    import NotificationComponent from '@/components/NotificationComponent.vue'

    export default {
        name: 'EditProductsComponent',
        created() {
            store.dispatch({ type: 'fetchProduct', productID: this.$route.params.id })
        },
        components: {
            FormProductsComponent,
            NotificationComponent
        },
        computed: {
            product() {
                return store.getters.getProduct
            },
            errors() {
                return store.getters.getErrors
            },
            error() {
                return store.getters.getError
            },
            success() {
                return store.getters.getSuccess
            }
        },
        methods: {
            updateProduct(e) {
                e.preventDefault();
                console.log(this.product)
                store.dispatch({ type: 'updateProduct', product: this.product })
            }
        }
    }
</script>