<template>
    <div class="view-products p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-0 col-sm-6 mt-2 row d-flex justify-content-end">
            <a href="/products" type="button" 
                class="btn btn-secondary mr-2">
                Back
            </a>
            <a :href="'/products/'+product.id+'/edit'" type="button" 
                class="btn btn-warning text-white">
                <edit-2-icon size="1.0x" class="custom-class"></edit-2-icon>
            </a>
        </div>
        <div class="card m-1 p-0 col-sm-6 mt-2">
            <div class="p-3 border-bottom">
                <h4>Name:</h4> <h6 class="text-muted">{{ product.name }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Description:</h4> <h6 class="text-muted">{{ product.description }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Amount:</h4> <h6 class="text-muted">{{ product.amount }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Price:</h4> <h6 class="text-muted">$ {{ product.price }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Orders:</h4> 
                <h6 class="text-muted">
                    <span class="pr-2"><strong>Total:</strong></span>{{ product.orders.length }}
                </h6>
                <a v-for="order in product.orders" :key="order.id"
                    :href="'/orders/'+order.id+'/details'">
                    <h6 class="text-muted pl-2">
                        - {{ order.quantity }} units for the customer {{ order.customer.name }}/{{ order.customer.cpf }}, $ {{ order.value }}
                    </h6>
                </a>
            </div>
            <div class="p-3 border-bottom">
                <h4>Created At:</h4> <h6 class="text-muted">{{ product.created_at }}</h6>
            </div>
            <div class="p-3">
                <h4>Last Update At:</h4> <h6 class="text-muted">{{ product.updated_at }}</h6>
            </div>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import { Trash2Icon, Edit2Icon } from 'vue-feather-icons'

    export default {
        name: 'ViewProductsComponent',
        components: {
            Trash2Icon,
            Edit2Icon
        },
        created() {
            store.dispatch({ type: 'fetchProduct', productID: this.$route.params.id })
        },
        computed: {
            product() {
                return store.getters.getProduct
            },
        }
    }
</script>