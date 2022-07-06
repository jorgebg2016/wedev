<template>
    <div class="view-orders p-3 p-0 col-sm-12 row d-flex justify-content-center">
        <div class="m-1 p-0 col-sm-6 mt-2 row d-flex justify-content-end">
            <a href="/orders" type="button" 
                class="btn btn-secondary mr-2">
                Back
            </a>
            <a :href="'/orders/'+order.id+'/edit'" type="button" 
                class="btn btn-warning text-white">
                <edit-2-icon size="1.0x" class="custom-class"></edit-2-icon>
            </a>
        </div>
        <div class="card m-1 p-0 col-sm-6 mt-2">
            <div type="button" class="p-3 border-bottom">
                <h4>Customer:</h4>
                <a :href="'/customers/'+order.customer.id+'/details'">
                    <h6 class="text-muted">{{ order.customer.name }} - {{ order.customer.cpf }}</h6>
                </a>
            </div>
            <div class="p-3 border-bottom">
                <h4>Product:</h4> 
                <a :href="'/products/'+order.product.id+'/details'">
                    <h6 class="text-muted">{{ order.product.name }} - {{ order.product.description }}</h6>
                </a>
            </div>
            <div class="p-3 border-bottom">
                <h4>Quantity:</h4>
                <h6 class="text-muted">{{ order.quantity }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Value:</h4> 
                <h6 class="text-muted">$ {{ order.value }}</h6>
            </div>
            <div class="p-3 border-bottom">
                <h4>Created At:</h4> 
                <h6 class="text-muted">{{ order.created_at }}</h6>
            </div>
            <div class="p-3">
                <h4>Last Update At:</h4> 
                <h6 class="text-muted">{{ order.updated_at }}</h6>
            </div>
        </div>
    </div>
</template>


<script>
    import store from '@/store/index.js'
    import { Trash2Icon, Edit2Icon, EyeIcon } from 'vue-feather-icons'

    export default {
        name: 'ViewOrderComponent',
        components: {
            Trash2Icon,
            Edit2Icon,
            EyeIcon
        },
        created() {
            store.dispatch({ type: 'fetchOrder', orderID: this.$route.params.id })
        },
        computed: {
            order() {
                return store.getters.getOrder
            },
        }
    }
</script>