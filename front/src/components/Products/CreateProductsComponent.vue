<template>
    <div class="create-products p-3 p-0 col-sm-12 row d-flex justify-content-center">
        
        <div class="m-1 p-2 col-sm-6 mt-2">
            <form @submit="storeProduct">
                <FormProductsComponent :product="product" :errors="errors" :error="error" />
                <div class="form-group">
                    <div class="input-group row p-0 m-0 d-flex justify-content-end">
                        <a href="/products" class="btn text-white btn-secondary mr-2" type="button">Back</a>
                        <button class="btn text-white btn-primary m-0" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import store from '@/store/index.js'
    import FormProductsComponent from './FormProductsComponent'

    export default {
        name: 'CreateProductsComponent',
        components: {
            FormProductsComponent
        },
        data() {
            return {
                product: {
                    name: null,
                    description: null,
                    amount: null,
                    price: null,
                }
            }
        },
        computed: {
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
            async storeProduct(e) {
                e.preventDefault();
                await store.dispatch({ type: 'storeProduct', product: this.product })
                if(this.success) this.$router.back()
            }
        }
    }
</script>